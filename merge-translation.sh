#!/bin/bash
from=$1;
if [ ! -e $from ]; then
  echo "Usage: ./merge-translation [from-path]";
  exit;
fi

enUS=`ls app/locale/en_US/*.csv`;
viVN="app/locale/vi_VN"
echo "Prepare to merge translation from $from to $viVN";
for a in $enUS;
do
  i=$(basename $a);
  dest="$viVN/$i";
  if [ ! -e $i ]; then
    echo "Create $dest...";
    touch $dest;
  fi
  fromFile=$from/$i;
  if [ -e "$fromFile" ]; then
    echo "Gonna append $from to the end of $dest";
    cat $fromFile >> $dest;
  fi
  echo "Filter out $dest to $i";
  cat $dest | sort | uniq >> $i;
  mv -f $i $dest;
done;
