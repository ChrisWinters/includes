#!/usr/bin/env node

/*!
 * Replace config: Update plugin version
 */

// Files replace will update.
export function pluginVersionFiles() {
  return [
    "./readme.txt",
    "./README.md",
    "./includes.php",
    "./package.json",
    "./package-lock.json",
    "./updates.json",
  ];
}

// Items replace to search for.
export function pluginVersionFrom(oldVersion) {
  return [
    "Stable tag: " + oldVersion, // File: readme.txt file
    "Current version:** " + oldVersion, // File: README.MD
    "Version: " + oldVersion, // File: includes.php
    "'plugin_version' => '" + oldVersion + "'", // File: includes.php
    '"version": "' + oldVersion + '"', // Files: package.json, package-lock.json, updates.json
    "tag/" + oldVersion, // File: updates.json
  ];
}

// Items replace will update to.
export function pluginVersionTo(newVersion) {
  return [
    "Stable tag: " + newVersion, // File: readme.txt file
    "Current version:** " + newVersion, // File: README.MD
    "Version: " + newVersion, // File: includes.php
    "'plugin_version' => '" + newVersion + "'", // File: includes.php
    '"version": "' + newVersion + '"', // Files: package.json, package-lock.json, updates.json
    "tag/" + newVersion, // File: updates.json
  ];
}
