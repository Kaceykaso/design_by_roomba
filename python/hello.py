#! /usr/bin/env python
# Saying hello with song
import serial
import create

# Create robot
robot = create.Create("/dev/ttyUSB0")
robot.toFullMode()

# Song
robot.playSong( [(60,8),(64,8),(67,8),(72,8)] ) # C chord
robot.playSong([(62,5)]) # D
robot.playSong([(64,5)]) # E
robot.playSong([(65,5)]) # F
robot.playSong([(67,5)]) # G
robot.playSong([(69,5)]) # A
robot.playSong([(71,5)]) # B
robot.playSong( [(60,8),(64,8),(67,8),(72,8)] ) # C chord
