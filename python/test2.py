# Another simple test script, with a little more planning
# Longer song, moves forwards and backwards, turns in place

import serial
import create

# Create robot
robot = create.Create("/dev/ttyUSB0")
robot.toFullMode()

#Get pose, play song, dance, play song, and re-get pose!

pose = robot.getPose()
print "My X is %s" % pose[0]
print "My Y is %s" % pose[1]
print "My Theta is %s" % pose[2]

# Song
robot.playSong( [(60,8),(64,8),(67,8),(72,8)] ) # C chord
robot.playSong([(62,5)]) # D
robot.playSong([(64,5)]) # E
robot.playSong([(65,5)]) # F
robot.playSong([(67,5)]) # G
robot.playSong([(69,5)]) # A
robot.playSong([(71,5)]) # B
robot.playSong( [(60,8),(64,8),(67,8),(72,8)] ) # C chord

robot.move(6) # Move forwards

# Jiggle
robot.turn(45,45) # 45 degrees counterclockwise, 10 degrees/s
robot.turn(-90,45) # 90 degrees clockwise, 10 degrees/s
robot.turn(45,45)

robot.move(-6) # Move backwards

# Song
robot.playSong( [(60,8),(64,8),(67,8),(72,8)] ) # C chord
robot.playSong([(62,5)]) # D
robot.playSong([(64,5)]) # E
robot.playSong([(65,5)]) # F
robot.playSong([(67,5)]) # G
robot.playSong([(69,5)]) # A
robot.playSong([(71,5)]) # B
robot.playSong( [(60,8),(64,8),(67,8),(72,8)] ) # C chord

pose = robot.getPose()
print "My X is %s" % pose[0]
print "My Y is %s" % pose[1]
print "My Theta is %s" % pose[2]
