# PHP Setup

Install supported PHP versions only. PHP 8.1 and older no longer get security fixes, see [supported versions](https://www.php.net/supported-versions.php).

```shell
brew install php@8.4
brew install php@8.3
brew install pkg-config
```

Need an end-of-life version for a legacy project? `shivammathur/php` has them, but they get no security fixes, so keep them off anything exposed to a network:

```shell
brew tap shivammathur/php
brew trust shivammathur/php
brew install shivammathur/php/php@7.4
```


### Install phpenv
The installer is pinned to a commit rather than `master`, so the script that runs doesn't change under you. Read it before piping to bash. It clones the latest `phpenv/phpenv` from GitHub.
```shell
curl -fsSL https://raw.githubusercontent.com/phpenv/phpenv-installer/ea78f2619fe9028ba42be6745579c4a998ed8460/bin/phpenv-installer | bash
```

Add to your .zshrc file & restart zsh `exec zsh`

```shell
export PHPENV_ROOT="$HOME/.phpenv"
if [ -d "${PHPENV_ROOT}" ]; then
  export PATH="${PHPENV_ROOT}/bin:${PATH}"
  eval "$(phpenv init -)"
fi
```

### Link each version of php installed by brew to ~/.phpenv/versions

```shell
curl -fsSL https://gist.githubusercontent.com/yuki777/6244823b8aa8cf4457e97e6407ada5ad/raw/e988f8a1c112e4063768664104ba14d799e63782/link-phps.bash | bash
```

source

```shell
#!/usr/bin/env bash

set -au

## Check cellar dir
cellarDir=$(brew --prefix)/Cellar
if [ ! -d "$cellarDir" ]; then
  echo "Not found. brew package path $cellarDir :("
  echo
  exit 1
fi

parentDirs=$(find $cellarDir/php* -type d -maxdepth 0)
echo "# Link the php installed by Brew to ~/.phpenv/versions"
for parentDir in $parentDirs
do
  childDirs=$(find "$parentDir"/* -type d -maxdepth 0)
  for childDir in $childDirs
  do
    phpPath=$childDir/bin/php
    if [ ! -f "$phpPath" ]; then
      continue
    fi
    major=$($phpPath -r 'echo PHP_MAJOR_VERSION;')
    minor=$($phpPath -r 'echo PHP_MINOR_VERSION;')
    patch=$($phpPath -r 'echo PHP_RELEASE_VERSION;')

    # unlink
    rm -f "$HOME"/.phpenv/versions/"$major"."$minor"
    rm -f "$HOME"/.phpenv/versions/"$major"."$minor"."$patch"

    # link
    linkCommand="ln -s $childDir $HOME/.phpenv/versions/$major.$minor"
    echo "$linkCommand"
    $linkCommand
    linkCommand="ln -s $childDir $HOME/.phpenv/versions/$major.$minor.$patch"
    echo "$linkCommand"
    $linkCommand
  done
done
```





### Notes on brew upgrade
Run again

```shell
curl -fsSL https://gist.githubusercontent.com/yuki777/6244823b8aa8cf4457e97e6407ada5ad/raw/e988f8a1c112e4063768664104ba14d799e63782/link-phps.bash | bash
```

## Refer

[yuki777 setup](https://dev.to/yuki777/install-multiple-php-versions-and-automatically-switch-versions-for-each-directory-1jop?signin=true)
