#!/bin/bash
set -x
set -euo pipefail

# Add SSH Key
eval $(ssh-agent -s)
ssh-agent -a /tmp/ssh_agent.sock > /dev/null
echo "$REMOTE_SSH_PRIVATE_KEY" | tr -d '\r' | ssh-add - > /dev/null
mkdir -p ~/.ssh && echo "StrictHostKeyChecking no" >> ~/.ssh/config

# Git Config
git config --global user.email "tools@enchantingtravels.com"
git config --global user.name "GitHub Deploy"

# Clone Pantheon Repo
git clone --single-branch --branch ${GITHUB_REF##*/} $REMOTE_GIT_REPOSITORY $HOME/remote-deploy --depth 1
cd $HOME/remote-deploy

# Copy MU Plugins
rm -rf wp-content/mu-plugins
cp -r $GITHUB_WORKSPACE/wp-content/mu-plugins wp-content

# Copy Plugins
rm -rf wp-content/plugins
cp -r $GITHUB_WORKSPACE/wp-content/plugins wp-content

# Copy Themes
rm -rf wp-content/themes
mv $GITHUB_WORKSPACE/wp-content/themes wp-content

# Copy Misc.
if test -f "wp-content/object-cache.php"; then
  rm wp-content/object-cache.php
fi
mv $GITHUB_WORKSPACE/wp-content/object-cache.php wp-content

# Copy Composer `vendor` Directory
rm -rf vendor
cp -r $GITHUB_WORKSPACE/vendor .

# Check if we have changes
if [[ -z $(git status -s) ]]; then
	# No changes
	echo "No changes to push"
else
	# Push changes to Pantheon
	git add .
	git status
	git commit -m "Deploy from GitHub $GITHUB_SHA"
	git push origin ${GITHUB_REF##*/}
fi

set +x
