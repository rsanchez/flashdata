# Flashdata

Set and get data from EE's built-in flashdata storage.

### Get Flashdata

	{exp:flashdata:get key="previous_last_segment"}

OR

	{exp:flashdata:your_key}

### Set Flashdata

	{exp:flashdata:set key="last_last_segment" value="{last_segment}"}

OR

	{exp:flashdata:set key="previous_last_segment"}{last_segment}{/exp:flashdata:set}

OR

	{exp:flashdata:your_key}your data here{/exp:flashdata:your_key}
