# Jvillage Message Template Defaults

This extension modifies some default settings for some message templates. 

It's important to note that it doesn't modify the actual configured template settings themselves -- only the defaults.  This means that the site admins may configure its templates however they want, but when they click "Revert to Default", CiviCRM will revert to the defaults defined by this extension, not to the defaults that are released with CiviCRM.

## Affected templates and settings 
This module changes the default values for the following templates and settings:

* Contributions - Receipt (off-line)
	* HTML Format
	* Plain-Text Format
* Contributions - Receipt (on-line)
	* HTML Format
	* Plain-Text Format


## Behavior on uninstall/disable/etc.
Default values are changed immediately upon installing or enabling this extension.

Upon disabling or uninstalling this extension, those default values are changed back to what they were in CiviCRM 4.7.18.

## Caveats and future considerations
**Take care with regard to CiviCRM versions:** Upon disabling or uninstalling this extension, default values are changed back to what they were in **CiviCRM 4.7.18**. This may not be appropriate where this extension is installed in a different  version of CiviCRM. Further development could be done to make this extension more intelligently compatible with a wider range of CiviCRM versions.
