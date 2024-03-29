<?php die();?>
Akeeba Backup 3.5.2
================================================================================
# [HIGH] Site Overrides' site root path was ignored
# [HIGH] Restoring a backup with multiple database definitions would result in the restoration getting stuck in a loop showing the main site db restoration page
# [MEDIUM] File filters for files in the site roto not respected when using the akeeba-backup.php CLI script
# [LOW] Import Archives did not parse directory variables like [DEFAULT_OUTPUT] and [SITEROOT]
# [LOW] You could no longer delete backup files or records through the JSON API
# [LOW] Error thrown in the component's control panel when Debug System is enabled
# [LOW] Wrong label "Database driver" instead of "Database hostname" in Site Overrides configuration (Professional release)
# [LOW] Backup notification icon would be permanently deactivated if a user without backup privileges (e.g. Administrator) tried to display it
# [LOW] Deleting a remotely stored backup could result in an error if there were too many parts
# [LOW] Strict notice in Administer Backup Files page

Akeeba Backup 3.5.1
================================================================================
+ Plugin for JMonitoring, notifies you on failed and stale backups
# [HIGH] Blank pages when accessing various Akeeba Backup views on some hosts which tried to load a certain PHP file twice, despite that making no sense whatsoever :s
# [HIGH] Obsolete files from very old releases (3.3.x and earlier) were not being removed, causing fatal errors.
# [MEDIUM] Restore points lacked the "Roll back" button
# [LOW] Akeeba Backup Core tries to install plugins existing only in the Professional release
# [LOW] Akeeba Backup Core would try to uninstall an inexistent module
# [LOW] The akeeba-backup.php CLI script wouldn't load the language files, causing the backup confirmation email to fail
# [LOW] A Javascript popup was shown when saving the Post-Configuration Wizard settings in Akeeba Backup Core

Akeeba Backup 3.5.0
================================================================================
~ Default minimum update stability is now set to stable
~ Akeeba Backup Core always updates to Stable only, irrespective of the user's preferences
~ The Post-Installation page now allows you to select the minimum update stability level
~ Auto-disable the Akeeba Backup icon module if a crash is detected, making sure that failed updates won't bring down your site
# Accessing Live Update threw a Not Authorized error
# Forgot to include the frontend dispatcher in the XML manifest. Thank you,	Daniele!
# The CLI scripts weren't copied when installing the Professional release
# The SRP and Update Check plugins wouldn't get installed in the Professional release
# The remote API for the SRP backup was broken. Thank you Daniele!
# FOF wasn't loaded by mod_akadmin, causing a fatal error to be thrown in the Joomla! control panel

Akeeba Backup 3.5.a2
================================================================================
! THIS IS AN ALPHA (TESTING) RELEASE. IT SHOULD NOT BE INSTALLED ON PRODUCTION (LIVE) SITES.
+ Allow Dropbox tokens to be copied across sites, allowing you to authenticate many sites to the same Dropbox account
# Live Update wouldn't work in Akeeba Backup 3.5.a1
# The warning about the Download ID would never go away
# Content-Disposition should wrap the filename in double quotes when downloading files

Akeeba Backup 3.5.a1
================================================================================
! THIS IS AN ALPHA (TESTING) RELEASE. IT SHOULD NOT BE INSTALLED ON PRODUCTION (LIVE) SITES.
+ Overhauled backup engine
+ Multi-db support (work in progress)
+ You can now add the Joomla! version in the archive's name using the [PLATFORM_VERSION] tag
+ Making sure you won't forget to enter your Download ID
+ Configure button next to profile's name in Profiles view
+ You can now override the site's root and/or database connection details, allowing you to backup any accessible on the server
+ #368 SugarSync integration
+ #396 Google Storage integration
+ New backup archive naming variable: [SITENAME]
+ #326 Added SRP support to the JSON API
~ Automatically update the XML update stream in Joomla! 2.5 to make use of the Download ID in the Pro release
~ ABI: Remove J! 1.5 support
# Accessing Akeeba Backup without adequate ACL priileges would cause an infinite redirection loop
# ABI: No progress bar shown in database restoration
# Functions, procedures and triggers were not being backed up correctly when their definition contained comments

Akeeba Backup 3.4.3
================================================================================
# Call time pass by reference removed in PHP 5.4.0, causing a fatal error when using Akeeba Backup on PHP 5.4
# The Box.net integration would copy the backup archive to the administrator directory and not delete it
# Regression: using the email after front-end backup causes a backup failure under Joomla! 2.5
# No emails after front-end backup sent under Joomla! 2.5

Akeeba Backup 3.4.2
================================================================================
# Some servers didn't create a correct OAuth signature for Dropbox' POST requests
# The Dropbox integration didn't work with PHP Safe Mode

Akeeba Backup 3.4.1
================================================================================
# Immediate crash in Joomla! 1.5 when the System - Legacy plugin is activated
# Dropbox authorisation step 1 would fail on some servers

Akeeba Backup 3.4.0
================================================================================
+ ABI: Updated jQuery and jQuery UI
+ ABI: Remember the preference to clear the database connection information when navigating between steps
+ #120 ABI: Ability to skip restoring select databases, except the one of the site (Skip instead of Next)
+ #121 Import arbitrary archives from S3
+ #248 Integrate with box.net cloud storage provider
+ The backup.php CRON script now supports a --debug switch so that it will dump any PHP errors
+ Finder tables (which can be rebuilt anytime) are now skipped by default, leading in MAJOR performance boost when backing up Joomla! 2.5 sites
~ Reimplementing Dropbox integration with their official API
# The update notification plugin could fire repeatedly if it wasn't able to update its last run timestamp
# ABI doesn't support MySQLi connection to non-standard (non-3306) ports
# Regression: multiple db backup didn't work
# The backup.php CRON script would not support send-by-email features under Joomla! 2.5.x

Akeeba Backup 3.3.13
================================================================================
+ You can now update Akeeba Backup Professional using the Joomla! extensions update (you still have to supply your Download ID to the component)
+ System Restore Points: Allow skipping table data with the <skiptables> element
# System Restore Points threw an error when updating a component
# The extension post-installation message would not show when System Restore Points was enabled
# Configuration overrides weren't being applied (affecting backup.php CRON script and System Restore Points)
# Language strings not showing on installation

Akeeba Backup 3.3.12
================================================================================
+ You can now force the language the update emails will be sent in
# Cancelling the edit of a backup record results in the display being filtered (thanks @brianteeman)
# The backup notification icon did not show on Joomla! 2.5.0 due to differences in Joomla's HTML markup
# backup.php stopped working with Joomla! 2.5.0 Stable

Akeeba Backup 3.3.11
================================================================================
+ Support for Amazon S3 RRS (Reduced Redundancy Storage)
~ Updating the CLI platform with the new location of Joomla! 2.5's version.php file
~ ABI: Warning message when Javascript is disabled during restoration
! Joomla! 2.5 requires passing the table prefix in getTable()
# The header in Administer Backup Files would change when using the pagination controls (thank you @brianteeman)
# A "Transfer Archive ()" link would appear even when there was no post-processing engine available (thank you @brianteeman)
# DropBox file operations (delete, download) were not working
# ABI: The configuration.php would show broken characters when non-ASCII characters were used in any field, e.g. site name or off-line message (kudos to Alexandros S. for the heads up)
# 311: Intermediate backup files are not removed after backup failure

Akeeba Backup 3.3.10
================================================================================
~ ABI: Bumped the minimum required PHP versions (5.1.6 for J! 1.5, 5.2.7 for J! 1.6+)
! Regression: No quotas would be applied

Akeeba Backup 3.3.9
================================================================================
! The SRP quotas would remove the latest system restore point, rendering the feature useless
~ Improved readability of update notification email (thank you Brian Teeman!)
# Suppressed warnings and notices would be reported in the log file, but they are expected to happen (they are file existence/read tests)
# Notice thrown in engine/abstract/archiver.php
# Suppressed warning thrown in engine/abstract/dump.php
# Suppressed warning thrown in AEConfiguration::reset()
# Suppressed warning thrown in AEUtilTempvars::reset()
# Suppressed warning thrown in AEDumpNative::createNewPartIfRequired()
# Suppressed warning thrown in AECoreDomainPack::pack_files()
# Suppressed warning thrown in AEAbstractArchiver::_addFile()

Akeeba Backup 3.3.8
================================================================================
+ UX: Remotely stored backups are now identified as "Remote" instead of "Obsolete" (kudos to Brian Teeman for proposing this)
+ UX: Renamed the Normal and Tabular views in Files and Directories Exclusion; added a more prominent link to the tabular view (kudos to Brian Teeman for proposing this)
+ ABI: You can now set the Cookie Domain and Cookie Path during restoration
# The pagination bar in the Restore Points would take you to the Backups page when clicked
# Joomla! 1.7 layout fixes
! System Restore Points were broken

Akeeba Backup 3.3.7
================================================================================
+ Add delete support for CloudFiles so that remote quotas are possible with it
+ Add download support for CloudFiles so that you can fetch archives back to your server
+ Add delete support for DropBox so that remote quotas are possible with it
+ Add download support for DropBox so that you can fetch archives back to your server
+ If Admin Tools Professional is installed, the update notification email link will include your administrator secret word.
~ Updated bundled JavaScript libraries to jQuery 1.7 and jQuery UI 1.8.16
# ABI: Invalid use of DS
# System Restore Point backups would appear in the "latest backup" view
# Sending backup completion emails was impossible from the CLI scripts (backup.php, altbackup.php)
# If you did not specify an email address, Akeeba Backup would fail fetching the Super Administator email addressed under Joomla! 1.7
# "Transfer Archive" would appear for obsolete backup records (Pro release)
# Regression: could not upload archives from the Administer Backup Files page
# Non-standard administrator templates could have a problem with the backup status icon module hiding everything on the page

Akeeba Backup 3.3.6
================================================================================
~ #247 Propose a fix for non-existent/unwritable backup output directory
# Cosmetic: #253 CHANGELOG would display an page showing [object] Object on Firefox
# Cosmetic: Tooltips on exclusion views would float out of view
# Make sure that we have at least PHP 5.2.7 before enabling the administrator module and the system plugins
# Backing up Thumbs.db and .DS_Store files cause extraction to fail on Windows and Mac OS X respectively; as of now, we don't back them up
! Command-line backup would not run on Joomla! 1.7 due to missing DS constant, still required by Joomla!

Akeeba Backup 3.3.5
================================================================================
+ Showing backup record ID in Administer Backup Files page
+ The Akeeba Backup admin icon now inlines itself to the Joomla! control panel's Quick Icons module
+ Display the CHANGELOG inside the component's Control Panel page
- Akeeba Backup Core feature moved to Professional: Update notification emails
- Akeeba Backup Core feature moved to Professional: System Restore Points
- Akeeba Backup Core feature moved to Professional: Site Transfer Wizard
- Akeeba Backup Core feature moved to Professional: All archiver engines except JPA
- Akeeba Backup Core feature moved to Professional: Most log level options
- Akeeba Backup Core feature moved to Professional: All backup types except full site and db-only backup
- Akeeba Backup Core feature moved to Professional: Date conditional filter
- Akeeba Backup Core feature moved to Professional: All quota settings except the basic ones (obsolete count, size, count)
- Akeeba Backup Core feature moved to Professional: Fine tuning settings except min/max execution time and runtime bias
# Regression: Count quotas would remove the latest, not the oldest, backup files
# Installing Akeeba Backup would remove the menu item link for Akeeba Subscriptions
# Akeeba Backup notification module: "Enable warnings" had no effect
# Use of AKEEBAPRO instead of AKEEBA_PRO in administrator/components/com_akeeba/views/backup/tmpl/default.php (fixed by doorknob)
# Untranslated string JGLOBAL_BATCH_COPY (this lang string was replaced in Joomla! 1.7)
# Would not show development version only updates
# GMT timezone used for the backup time stamp in Joomla! 1.7 instead of the user's timezone.
# ABI: It would leave behind akeeba_connection_test.png in the site's root, created by Akeeba Backup's Site Transfer Wizard
# Notice thrown by the native dump engine (cosmetic issue)

Akeeba Backup 3.3.4
================================================================================
+ Explanatory text regarding archive restoration in the Core release, when you visit the Administer Backup Files page
+ Improved message in the case of an error which will help you solve the issue yourself
+ ACL checks in the backup status administrator module
+ Row-level filtering is now possible (by creating a PHP filter file)
+ ABI is now self-documenting; no excuses for not reading the fine manual any more!
+ Added warning about UNC paths when used as the site's root, since PHP is very often buggy with respect to UNC paths
~ Modified the success message after taking a System Restore Point, backing up before upgrading Joomla! or otherwise take a backup as part of an automated process with a return URL
~ backup.php now returns exit code 1 if there were warnings or 2 if the backup failed on an error
~ Changed Akeeba Backup's installation page to better lead you to your next steps.
~ Renamed jquery.js to akeebajq.js due to some system plugins removing all instances of jquery.js from the page source (whichever idiot wrote them!)
~ Renamed jquery-ui.js to akeebajqui.js due to some system plugins removing all instances of jquery-ui.js from the page source (whichever idiot wrote them!)
~ Updated SRP definitions for Akeeba Backup, Admin Tools, Akeeba Subscriptions and Akeeba Release System
# tmp directory would not be cleaned up after extensions installation when SRP is used
# The Configuration page would not render on IE7, IE8 and IE9 (the latter only when using Compatibility mode)
# Backup age quotas caused the backup finalization to crash on PHP 5.2
# --quiet option added to backup.phpto suppress output except warnings and errors
# When using a developer's release, Live Update would always report that a newer version is available
# When a Windows server is using a UNC path for the site's root, the backup always failed
# When jQuery wasn't loaded, the message urged you to use Google AJAX API, which is no longer an option.
# ABI: Would always report that the storage isn't working when the session save path is unwritable but ABI could create a storage file to store session information.
# Quotas would delete the most recent files, not the oldest files

Akeeba Backup 3.3.3
================================================================================
~ Live Update and Joomla! XML update feed now tuned to look for updates through our CloudFront CDN distribution for faster results
~ Huge text describing what the update link does, what it doesn't and how to disable it added to update notification emails
# Akeeba Backup Update Check: version.php not loaded, causing it to believe that there is always an update available
# Restoration of a System Restore Point would not restore database content if it was very big (thanks to the guys at Migur for discovering it)
# During a System Restore Point restoration the database restoration progress would not be printed out
# Timezone was reset to UTC on Joomla! 1.6 and later when the server default timezone wasn't set, instead of letting Joomla! define the timezone based on Global Configuration preferences
# System Restore Points wouldn't run for component installations on Joomla! 1.5 running on Linux servers

Akeeba Backup 3.3.2
================================================================================
~ UI fixes for Joomla! 1.7
~ Improved Control Panel layout to better give at-a-glance information
~ Replaced remaining $mainframe references with JFactory::getApplication()
# The "Post-installation" view would load repeatedly on some servers
# Workaround for Joomla! 1.6+ bug resulting in "Can not build admin menus" and "DB function reports no error" messages when trying to install the component after a failed installation/update
# Site crash if somehow the component directories were removed but the module or plugins were not uninstalled
# Improved installation and uninstallation under Joomla! 1.6/1.7, working around Joomla! bugs which would prevent installation
# CLI backup would not run on sites running on Joomla! 1.7
# Akeeba Backup Update Check would send out emails even when no update information was retrieved from the updates server

Akeeba Backup 3.3.1
================================================================================
! The new quota implementation wasn't compatible with PHP 5.2 and threw a fatal error

Akeeba Backup 3.3.0
================================================================================
+ Maximum age quota limits; allows for, say, only monthly and last 30 day backups to be kept
+ #175 Post-installation view should "remember" user's settings
+ You can now define the maximum size System Restore Points will occupy on your server
# Obsolete count quota would only keep the last 10 records when enabled, no matter the user's choice
# #162 Force reload update information in the post-installation view
# Live Update would not refresh the version status after applying an update
# The "back to Control Panel" button in Step 3 of the Site Transfer Wizard would do nothing at all
# Some buggy servers report file lengths as floats, misleading Akeeba Backup into believing that it is unable to backup correctly the site's files
# Inversion of logic on AEPlatform::get_site_root() would cause issues on servers which report "/" as the site's root
# The ACL view in Joomla! 1.5 wouldn't allow you to change the permissions for individual users
# Post-installation setup would always ignore user's preference about automatic update emails and never enable the feature
# The post-installation page could appear over and over again on a new installation
# #176 System Restore Points interfere with the backup notification module
# ABI: Invisible newlines could cause PHP sessions to go haywire, not allowing the restoration to proceed
# Joomla! 1.6 wouldn't run the SQL file on update, causing potential update failure
# Quotas and post-processing would be applied to System Restore Points
# System Restore Points would have a download link
# System Restore Points would have an edit link which, of course, does nothing

Akeeba Backup 3.3.b1
================================================================================
+ Post-setup configuration wizard
+ #97 Akeeba Backup can now detect if its tables are broken and attempt to fix them, or warn you that it can't work properly
+ #29 Upload already taken, locally stored backup archives to remote storage any time
+ You are now able to select if you will be notified by Live Update for alpha, beta and RC versions.
~ Changed the page title to "System Restore Point in progress" when taking a System Restore Point
~ Changed all button to native button elements instead of Joomla!-styled input elements so that buttons DO LOOK like buttons
~ UI fix to cater for RocketTheme's MissionControl back-end template
~ UI fix for Nooku Server Alpha 3 (the flex-box was killing our layout)
~ Improved tooltips for clarity and usability
~ Changed label of Backup Now view to "Site Transfer Wizard" when it's called from the Site Transfer Wizard
~ Changed lable of "Backing up files" step to read "Transferring files to remote server" when a Site Transfer Wizard backup is running
~ Added a message before Site Transfer Wizard transfers you to the new site to complete the restoration
# Update check plugin: it would run all the time, without checking its last run time
# Live Update: The caching never worked, resulting in repeated hits to the update server
# Live Update: Current version number wouldn't always show up with svn releases
# The administrator backup notification icon module wasn't removed on component uninstall
# Large files in ZIP archives would always have a wrong uncompressed size of 4Gb
# Remote files quotas would not be applied
# Invalid ZIP central directory record generated meant the archive wouldn't be extracted by thirdparty unarchivers
# Invalid file size stored for large files when the ZIP format was being used
# If no files were being backed up from a root directory, an empty directory entry would be created, potentially making extraction impossible
# The remote API wouldn't return progress information
# Live Update: crashes on Joomla! 1.6 after caching fix
# Installation of a component using SRP in Joomla! 1.6 would cause the output of the install.component.php to never be displayed, causing potential installation issues
# ABI: "No database definitions found" error on some misbehaving servers
# One Click Actions: MySQL query error when auto-expiring old entries
# 156 Temporary directory not pre-populated in enhanced installer
# Files inside media/com_akeeba changed to 0755 permissions instead of the intended 0644

Akeeba Backup 3.3.a2
================================================================================
~ Remove alternate jQuery sources. The included jQuery library can be loaded on all sites (unless the permissions are broken, but you receive a warnign about it).
~ Renamed "Back" button to "Control Panel" (thank you, Brian Teeman, for the UX hint!)
~ Forward compatibility with 1.7 based on BC notes in http://docs.joomla.org/Potential_backward_compatibility_issues_in_Joomla_1.7_and_Joomla_Platform_11.1
# Directory browser: Using the "Go" button results in an error message.
# Can not override some configuration variables from the CLI
# S3: could not upload (it never took the bucket name)
# Fatal error coming from Live Update when accessing the component under Joomla! 1.6
# cacert.pem missing from package
# Update check emails could be sent en masse, instead of once every day to each Super Administrator
# Update check emails would severely malfunction on Joomla! 1.6
# "System - Akeeba Backup Update Check" plugin had the wrong name in the XML file

Akeeba Backup 3.3.a1
================================================================================

+ DirectSFTP engine, allows directly transferring your site to a remote SFTP server
+ Alternate directory scanning method, working around some servers not listing all files, leading to missing files from the backups
+ Site Transfer Wizard so that you can easily transfer your sites between hosts
+ web.config file in the backup output directory to prevent direct web access to the directory on IIS-based hosts
+ System Restore Points: extension developers can instruct Akeeba Backup to take SRPs before upgrades for that extra peace of mind
+ #125 Allow per-extension system restoration point overrides
+ Akeeba Backup now uninstalls its modules and plugins when you uninstall the component (how did I miss that?!)
+ #111 Add warning for low memory limit
+ #107 Optional storage of temporary data to the database instead of files
+ #131 One click update emails to Super Administrators
+ Live Update now takes a System Restore Point before upgrade when this feature is enabled
# RackSpace CloudFiles: Did not support UK-based accounts; added an option for that (thanks Dean!)
# #92 Restoring an 1.6 site results to configuration.php artifacts
# #95 Live site URL not stored in component configuration
# #96 JS/CSS files out of date after upgrade, due to browser caching
# #93 Using HTTPS with cURL fails on some servers
# #123 S3: Automatically remove / from the bucket name
# #124 S3: Do not lowercase the bucket name
# #112 Live Update doesn't work on hosts with open_basedir restrictions
# Can not backup a site on some broken hosts which report an empty string as the site's root *and* do not parse relative directories correctly