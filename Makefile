all:

install:
	mkdir -p $(DESTDIR)/opt/dtweb
	mkdir -p $(DESTDIR)/usr/share/applications
	mkdir -p $(DESTDIR)/usr/sbin
	cp -r public webapp dtbkernel*.tar.bz2 dtweb-headless.sh $(DESTDIR)/opt/dtweb
	cp utils/* $(DESTDIR)/usr/sbin/
