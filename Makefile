LIBS = -lpcap -I/usr/include/mysql -L/usr/lib/x86_64-linux-gnu -lmysqlclient -lpthread -lz -lm -lrt -latomic -lssl -lcrypto -ldl -I/usr/include/mysql
CC=gcc $(LIBS)
CFLAGS = -g3 -O2 -Wall 


all	: pcap.o 
	@echo "Building Binary Executable..."
	$(CC) -o pcap pcap.o $(LIBS) 
	@echo "Done."


