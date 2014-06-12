#! /usr/bin/env python
# Circle script
# Executed when asked to draw a circle by the user
# Draws a 12 inch circle

import serial
import create
from time import strftime

# Create robot
robot = create.Create("/dev/ttyUSB0")
robot.toFullMode()

# Draw circle
# Circumference of circle with diameter of 12.5" ~ 2pi(22.5) = 141
robot.go(141,-360)
# Will turn forever, in PHP call stop script after ~1s
