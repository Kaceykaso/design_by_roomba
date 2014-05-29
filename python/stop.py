#! /usr/bin/env python
# Stop script
# Stops the Create from doing whatever it's currently doing, can be called anytime

import serial
import create
from time import strftime

# Create robot
robot = create.Create("/dev/ttyUSB0")
robot.toFullMode()

# Stop
robot.stop()

