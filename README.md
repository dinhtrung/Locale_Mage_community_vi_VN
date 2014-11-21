Locale_Mage_community_vi_VN
===========================

- Merge bản dịch

```
merge-translation.sh app/locale/vi_VN-com
merge-translation.sh app/locale/vi_VN-stc
merge-translation.sh app/locale/vi_VN-stc/old
```

- Filter
```
for i in `ls app/locale/vi_VN/*.csv`; do echo $i; php filter.php $i; done;
```
- Uniq

```
for i in `ls app/locale/vi_VN/*.csv`; do echo $i; j=`basename $i`; cat $i | sort | uniq >> $j; mv -f $j $i; done;
```
