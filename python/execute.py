#
#
#
#
#
#
#
#
#
#
#

#import serial
#import create
#import time

# Create robot

# Set to Full Mode

# Get robot's current position, write to file
#firstPose = robot.getPose()

# Read in command from index.php
with open('../clicked.txt','r') as f:
	#for line in f:
		#print line
	file_size = f.tell()
	f.seek(max(file_size - 2*1024, 0))

	# this will get rid of trailing newlines, unlike readlines()
	last_10 = f.read().splitlines()[-10:]
	# Throw exception if less than 10 lines, give number of lines
	#assert len(last_10) == 10, "Only read %d lines" % len(last_10)
	count = len(last_10)
	print "I read %s lines, and they are:" % count
	for x in range(0,count):
		print "%s" % last_10[x]
	print "The last command made was: %s" % last_10[count-1]

# Give robot command

# Get robot's new position, write to file

# Compare 10 positions? Evaluate drawing so far...

# Give opinion in a song

# Enter in robot commands based on opinion