
Serial device(p9, p10);  // tx, rx
 
DigitalOut led1(LED1);
DigitalOut led2(LED2);
DigitalOut led3(LED3);
DigitalOut led4(LED4);
 
// Definitions of iRobot Create OpenInterface Command Numbers
// See the Create OpenInterface manual for a complete list
 
//                 Create Command              // Arguments
const char         Start = 128;
const char         SafeMode = 131;
const char         FullMode = 132;
const char         Drive = 137;                // 4:   [Vel. Hi] [Vel Low] [Rad. Hi] [Rad. Low]
const char         DriveDirect = 145;          // 4:   [Right Hi] [Right Low] [Left Hi] [Left Low]
const char         Demo = 136;                 // 2:    Run Demo x
const char         Sensors = 142;              // 1:    Sensor Packet ID
const char         SensorStream = 148;         // x+1: [# of packets requested] IDs of requested packets to stream
const char         QueryList = 149;            // x+1: [# of packets requested] IDs of requested packets to stream
const char         StreamPause = 150;          // 1:    0 = stop stream, 1 = start stream
const char         LED_Color = 139;
const char         PlaySong = 141;
const char         Song = 140;
 
/* iRobot Create Sensor Paqcket IDs */
const char         BumpsandDrops = 7;
const char         Distance = 19;
const char         Angle = 20;
 
char Color = 128;
/* Global variables with sensor packet info */
char Sensor_byte_count = 0;
char Sensor_Data_Byte = 0;
char Sensor_ID = 0;
char Sensor_Num_Bytes = 0;
char Sensor_Checksum = 0;
char Old_Sensor_Data_Byte = 0;
int speed_left =  200;
int speed_right = 200;
 
void start();
void receive_sensor();
void forward();
void reverse();
void left();
void right();
void stop();
void playsong();
void charger();
void LED_Pulse();
 
//
// Demo to read in sensor data with serial interrupts
//
int main() {
// wait for Create to power up to accept serial commands
    wait(3);
// set baud rate for Create factory default
    device.baud(57600);
// Start command mode and select sensor data to send back
    start();
// Setup a serial interrupt function to receive data
    device.attach(&receive_sensor);
// Main program keeps running - it loops sending out commands to change Create LEDs color
// Code to control robot here using sensor data and sending motor commands
//
// Start rolling forward
    forward();
    while (1) {
// Change color of Create LED - it's alive indicator
        LED_Pulse();
// Check sensor data from interrupt routine
        Old_Sensor_Data_Byte = Sensor_Data_Byte;
// Roll forward until hitting bumper
        if (Old_Sensor_Data_Byte &0x0F) {
// Stop and back up a bit
            stop();
            reverse();
// Beep Ouch!
            playsong();
            wait(.2);
// Rotate away from object
            if (Old_Sensor_Data_Byte &0x02)
                right();
            else
                left();
            wait(.3);
// Try forward again
            forward();
        }
    }
}
 
 
// Start  - send start and safe mode, start streaming sensor data
void start() {
    // device.printf("%c%c", Start, SafeMode);
    device.putc(Start);
    device.putc(SafeMode);
    wait(.5);
    //  device.printf("%c%c%c", SensorStream, char(1), BumpsandDrops);
    device.putc(SensorStream);
    device.putc(1);
    device.putc(BumpsandDrops);
    wait(.2);
}
 
// Interrupt Routine to read in serial sensor data packets - BumpandDrop sensor only
void receive_sensor() {
    char start_character;
// Loop just in case more than one character is in UART's receive FIFO buffer
    while (device.readable()) {
        switch (Sensor_byte_count) {
// Wait for Sensor Data Packet Header of 19
            case 0: {
                start_character = device.getc();
                if (start_character == 19) Sensor_byte_count++;
                break;
            }
// Number of Packet Bytes
            case 1: {
                Sensor_Num_Bytes = device.getc();
                Sensor_byte_count++;
                break;
            }
// Sensor ID of next data value
            case 2: {
                Sensor_ID = device.getc();
                Sensor_byte_count++;
                break;
            }
// Sensor data value
            case 3: {
                Sensor_Data_Byte = device.getc();
                Sensor_byte_count++;
                break;
            }
// Read Checksum and update LEDs with sensor data
            case 4: {
                Sensor_Checksum = device.getc();
                // Could add code here to check the checksum and ignore a bad data packet
                led1 = Sensor_Data_Byte &0x01;
                led2 = Sensor_Data_Byte &0x02;
                led3 = Sensor_Data_Byte &0x04;
                led4 = Sensor_Data_Byte &0x08;
                Sensor_byte_count = 0;
                break;
            }
        }
    }
    return;
}
// Stop  - turn off drive motors
void stop() {
    device.putc( DriveDirect);
    device.putc(char(0));
    device.putc(char(0));
    device.putc(char(0));
    device.putc(char(0));
}
// Forward  - turn on drive motors
void forward() {
    device.putc(DriveDirect);
    device.putc(char(((speed_right)>>8)&0xFF));
    device.putc(char((speed_right)&0xFF));
    device.putc(char(((speed_left)>>8)&0xFF));
    device.putc(char((speed_left)&0xFF));
}
// Reverse - reverse drive motors
void reverse() {
    device.putc(DriveDirect);
    device.putc(char(((-speed_right)>>8)&0xFF));
    device.putc(char((-speed_right)&0xFF));
    device.putc(char(((-speed_left)>>8)&0xFF));
    device.putc(char((-speed_left)&0xFF));
 
}
// Left - drive motors set to rotate to left
void left() {
    device.putc(DriveDirect);
    device.putc(char(((speed_right)>>8)&0xFF));
    device.putc(char((speed_right)&0xFF));
    device.putc(char(((-speed_left)>>8)&0xFF));
    device.putc(char((-speed_left)&0xFF));
}
// Right - drive motors set to rotate to right
void right() {
 
    device.putc(DriveDirect);
    device.putc(char(((-speed_right)>>8)&0xFF));
    device.putc(char((-speed_right)&0xFF));
    device.putc(char(((speed_left)>>8)&0xFF));
    device.putc(char((speed_left)&0xFF));
}
// Charger - search and return to charger using IR beacons (if found)
void charger() {
    device.putc(Demo);
    device.putc(char(1));
}
// Play Song  - define and play a song
void playsong() { // Send out notes & duration to define song and then play song
 
    device.putc(Song);
    device.putc(char(0));
    device.putc(char(2));
    device.putc(char(64));
    device.putc(char(24));    
    device.putc(char(36));
    device.putc(char(36));
    wait(.2);
    device.putc(PlaySong);
    device.putc(char(0));
}
void LED_Pulse() { // Send out a command for different colors on the create LED
    device.putc(LED_Color);
    device.putc(char(0));
    device.putc(char(Color));
    device.putc(char(200));
    Color +=64;
    wait(.05);
}
