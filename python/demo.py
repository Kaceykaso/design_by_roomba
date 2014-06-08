#! /usr/bin/env python
import serial
import time

N = "/dev/ttyUSB0"
s = serial.Serial(N, 57600, timeout=4)

