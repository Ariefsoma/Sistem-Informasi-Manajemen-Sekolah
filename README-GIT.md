Backup to GitHub - instructions

This file contains commands to create a local git repository, commit the project, and push to your GitHub repository named `Sistem-Informasi-Manajemen-Sekolah`.

Prerequisites
- Git installed and configured (git --version must work)
- A GitHub repository created under your account named `Sistem-Informasi-Manajemen-Sekolah` (you can create it on https://github.com/new)
- A GitHub personal access token (PAT) with repo permissions if you plan to use HTTPS, or SSH key configured for SSH pushes.

Commands to run in PowerShell (replace <YOUR_GITHUB_USERNAME> and optionally the remote URL):

cd C:\xampp\htdocs\SIMS

# initialize git (if not yet initialized)
git init

# set your name/email if not set
git config user.name "Your Name"
git config user.email "you@example.com"

# add files and commit
git add .
git commit -m "Initial commit - SIMS backup"

# add remote - use HTTPS (recommended if you have PAT) or SSH
# HTTPS example:
# git remote add origin https://github.com/<YOUR_GITHUB_USERNAME>/Sistem-Informasi-Manajemen-Sekolah.git
# SSH example:
# git remote add origin git@github.com:<YOUR_GITHUB_USERNAME>/Sistem-Informasi-Manajemen-Sekolah.git

# push to GitHub
# if using HTTPS and PAT, you will be prompted for username (use your GitHub username) and for password use the PAT
# for first push to main branch do:
git branch -M main
git push -u origin main

If you need me to push from this machine I will need a token or SSH key configured here. Otherwise run these commands locally after installing Git and creating the GitHub repository.
