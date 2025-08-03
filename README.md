# Disclaimer

This fork, based on [mcguirepr89/BirdNET-Pi](https://github.com/mcguirepr89/BirdNET-Pi), is designed for x86_64 (virtual) machine compatibility of BirdNET-Pi. Visit the original repository for more details, I'll only describe the changes here.

I run BirdNET-Pi within a KVM virtual machine hosted on a Dell T20 with [OMV](https://www.openmediavault.org/).

> [!WARNING]
> Certain actions, such as updating or uninstallation, have not been tested. Proceed at your own risk, or, even better, contribute your experiences with these actions.

## Requirements
* A device running Debian 11 in x86_64.
* Some kind of audio input (RTSP stream, microphone)

## Changes
### newinstaller.sh

**Changed architecture check**
```
if [ "$(uname -m)" != "aarch64" ];then
```
to
```
if [ "$(uname -m)" != "x86_64" ];then
```

**Removed**
```
branch=main
git clone -b $branch --depth=1 https://github.com/mcguirepr89/BirdNET-Pi.git ${HOME}/BirdNET-Pi &&
```
### requirements.txt

**Changed**
```
tflite_runtime-2.6.0-cp39-none-linux_aarch64.whl
```
to
```
tflite_runtime
```
### scripts/install_birdnet.sh

**Changed architecture check**

```
if [ "$(uname -m)" != "aarch64" ];then
```
to
```
if [ "$(uname -m)" != "x86_64" ];then
```
### scripts/install_services.sh

**Changed**
```
ExecStart=/usr/local/bin/gotty --address localhost -p 8080 -P log --title-format "BirdNET-Pi Log" birdnet_log.sh
```
to
```
ExecStart=/usr/local/bin/gotty --address localhost -p 8080 --path log --title-format "BirdNET-Pi Log" birdnet_log.sh
```

**Changed**
```
ExecStart=/usr/local/bin/gotty --address localhost -w -p 8888 -P terminal --title-format "BirdNET-Pi Terminal" login
```
to
```
ExecStart=/usr/local/bin/gotty --address localhost -w -p 8888 --path terminal --title-format "BirdNET-Pi Terminal" login
```

### scripts/gotty

Added gotty_v1.5.0_linux_amd64 from [sorenisanerd/gotty](https://github.com/sorenisanerd/gotty).



## Installation
```
git clone https://github.com/ostpol/BirdNET-Pi-x86_64.git && ./BirdNET-Pi-x86_64/newinstaller.sh
```