#! /usr/bin/env python
import serial
import time
import sys

# Serial port
N = "/dev/ttyUSB0"

def ints2str(lst):
    '''
    Taking a list of notes/lengths, convert it to a string
    '''
    s = ""
    for i in lst:
        if i < 0 or i > 255:
            raise Exception
        s = s + str(chr(i))
    return s

# do some initialization magic
s = serial.Serial(N, 57600, timeout=4)
# start code
s.write(ints2str([128]))
# Full mode
s.write(ints2str([132]))

# Drive
s.write(ints2str([137, 1, 44, 128, 0]))
# wait
s.write(ints2str([156, 1, 144]))
# Turn
s.write(ints2str([137, 1, 44, 0, 1]))
#wait
s.write(ints2str([157, 0, 90]))

sys.exit()


