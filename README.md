Rendezvous
==========

Rendezvous implements a web-based system for booking appointments for
examination.  The appointment booking portion (Rendezvous) has been
used extensively in multiple courses at the University of Crete over
the course of the last few years.

This is a derivative work of the
[Submit-Rendezvous](https://github.com/papamix/submit_rendezvous)
project.

For licensing information please see the LICENSE file.

## Setup

In order to run Rendezvous for a particular class, you need to `ssh` into the
server and switch to your web directory, e.g. by running:

```bash
cd public_html
```

If you already have another copy of RV installed, you can remove it by running
for example:

```bash
rm -fR rv
```

And now you can download a fresh copy of the software by running:

```bash
git clone https://github.com/zakkak/rendezvous.git rv
```

You can replace `rv` with anything else you want, and the website will be
available in the proper path. Right now, this will be `/rv/`.

**WARNING**: This will install the latest version of rendezvous which may be
under development. Although it will most likely work, you may want to use a
[release](https://github.com/zakkak/rendezvous/tags). You can `cd` inside the folder and then run:

```bash
git tag -l
```

This will show you a list of versions / releases of the software that are
available, and you can select one (e.g. the latest) by running:

```bash
git checkout v3.1.0
```

where `v3.1.0` is the version of rendezvous you want to install.

You can now find a file named `conf.php` that contains important variables you
should edit. These include the website title, as well as some additional pieces
of text. Within this file there's also the `$admins` array that includes a list
of e-mail addresses of the instance administrators that can create slots, view
reservations, etc.

You can now visit the website in which you set up the software, and proceed
with all the needed changes there. On your first visit, the database will be
created and everything will be installed and initialized properly.
