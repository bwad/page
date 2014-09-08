
# Makefile for page command
#
#	Planned Targets:
#

page: 
	rm -f bin/page
	cat src/usage.sh > bin/page
	cat src/utils.sh >> bin/page
	cat src/resource.sh >> bin/page
	
	cat src/projects/*.sh >> bin/page
	cat src/templates/*.sh >> bin/page
		
	cat src/commands/*.sh >> bin/page
	
	cat src/main.sh >> bin/page
	
	chmod u+x bin/page
	
test:
	@cd test; \
	for tst in ./*_test.sh; do \
	  bash $$tst; \
	done; \
	cd ..
	
install: 
	cp bin/page ${HOME}/bin/page
	mkdir -p ~/.page/resources
	cp -R resources ~/.page
		
.PHONY: test
	