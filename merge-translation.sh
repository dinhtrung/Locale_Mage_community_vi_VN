#!/bin/bash

for a in $(ls ../en_US/*.csv);
do
  i=$(basename $a);
  if [ ! -e $i ]; then
    echo "Create $i...";
    touch $i;
  fi
  old=Old$i;
  if [ -e "$old" ]; then
    echo "Found $old in current dir";
    cat $old >> $i;
    rm -f $old;
  fi
  dep=Deprecated$i;
  if [ -e "$dep" ]; then
    echo "Found $dep in current dir";
    cat $dep >> $i;
    rm -f $dep;
  fi
  j=tmp$i;
  cat $i | sort | uniq >> $j;
  mv -f $j $i;
done;
