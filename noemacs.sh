#!/bin/sh
find . \( -name '.*~' -or -name '*~' -or -name '#*#' -or -name '.#*' \) -print -exec rm -f {} \;