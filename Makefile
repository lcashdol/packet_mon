LIBS = -lpcap
CC=gcc
CFLAGS = -g3 -O2 -Wall $(DEFS)


all	: pcap.o
	@echo "Building Binary Executable..."
	$(CC) -o pcap pcap.o $(LIBS) 
	@echo "Done."


