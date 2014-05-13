import serial;
import create;

robot = create.Create("/dev/ttyUSB0");

robot.toSafeMode();

robot.go(6,0);
robot.stop();

robot.playSong( [(60,8),(64,8),(67,8),(72.)] );

pose = robot.getPose();
print "My X is %s" % pose[0];
print "My Y is %s" % pose[1];
print "My Theta is %s" % pose[2];