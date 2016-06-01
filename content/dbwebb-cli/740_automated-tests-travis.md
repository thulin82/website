---
author: mos
updated: "2016-05-02 09:00:00"
...
Automatiserade tester på Travis
==================================

Varje gång man checkar in kod till kursrepot på GitHub, eller om någon gör en pull request, så körs en automatiserad testsuite på webbtjänsten Travis.



Nuvarande status {#status}
----------------------------------

Så här ser nuvarande status ut för de senaste testerna som körts på Travis och CircleCI.

| Kursrepo | Status [Travis](https://travis-ci.org/) | Status [CircleCI](https://circleci.com/) |
|----------|------|------|
| [python](https://github.com/dbwebb-se/python) | [![Build Status](https://travis-ci.org/dbwebb-se/python.svg?branch=master)](https://travis-ci.org/dbwebb-se/python) | [![CircleCI](https://circleci.com/gh/dbwebb-se/python.svg?style=svg)](https://circleci.com/gh/dbwebb-se/python) |
| [htmlphp](https://github.com/dbwebb-se/htmlphp) | [![Build Status](https://travis-ci.org/dbwebb-se/htmlphp.svg?branch=master)](https://travis-ci.org/dbwebb-se/htmlphp) | [![CircleCI](https://circleci.com/gh/dbwebb-se/htmlphp.svg?style=svg)](https://circleci.com/gh/dbwebb-se/htmlphp) |
| [oopython](https://github.com/dbwebb-se/oopython) | [![Build Status](https://travis-ci.org/dbwebb-se/oopython.svg?branch=master)](https://travis-ci.org/dbwebb-se/oopython) | [![CircleCI](https://circleci.com/gh/dbwebb-se/oopython.svg?style=svg)](https://circleci.com/gh/dbwebb-se/oopython) |

Följande kursrepon är ännu inte överförda i senaste versionen av automatiserade tester.

| Kursrepo | Status |
|----------|--------|
| [oophp](https://github.com/mosbth/oophp) | [![Build Status](https://travis-ci.org/mosbth/oophp.svg?branch=master)](https://travis-ci.org/dbwebb-se/oophp) |
| [phpmvc](https://github.com/dbwebb-se/phpmvc) | [![Build Status](https://travis-ci.org/dbwebb-se/phpmvc.svg?branch=master)](https://travis-ci.org/dbwebb-se/phpmvc) |
| [javascript](https://github.com/mosbth/javascript) | [![Build Status](https://travis-ci.org/mosbth/javascript.svg?branch=master)](https://travis-ci.org/dbwebb-se/javascript) |
| [javascript1](https://github.com/mosbth/javascript1) | [![Build Status](https://travis-ci.org/mosbth/javascript1.svg?branch=master)](https://travis-ci.org/dbwebb-se/javascript1) |
| [linux](https://github.com/mosbth/linux) | [![Build Status](https://travis-ci.org/mosbth/linux.svg?branch=master)](https://travis-ci.org/dbwebb-se/linux) |
| [webapp](https://github.com/mosbth/webapp) | [![Build Status](https://travis-ci.org/mosbth/webapp.svg?branch=master)](https://travis-ci.org/dbwebb-se/webapp) |
| [webgl](https://github.com/mosbth/webgl) | [![Build Status](https://travis-ci.org/mosbth/webgl.svg?branch=master)](https://travis-ci.org/dbwebb-se/webgl) |
| [design](https://github.com/mosbth/design) | [![Build Status](https://travis-ci.org/mosbth/design.svg?branch=master)](https://travis-ci.org/dbwebb-se/design) |




Konfigurering på Travis {#config}
----------------------------------

Varje kursrepo har en konfigurationsfil `.travis.yml` som styr vad som testas. I princip är det den [lokala utvecklingsmiljön](development-environment) som används via följande kommandosekvens.

```bash
$ make automated-tests-prepare automated-tests-check automated-tests-run
```

Om du har installerat en lokal utvecklingsmiljö så kan du alltså köra exakt samma tester som körs via Travis.
