# Nodejs Setup

### Install nvm (Node version manager)
```shell
brew install nvm
```

### Lazy-load nvm (faster shell startup)
Sourcing `nvm.sh` in `~/.zshrc` adds about a second to every new shell. Instead, put the default node on `PATH` directly and only load nvm the first time `nvm` is run:
```shell
export NVM_DIR=~/.nvm
_nvm_default=$(<"$NVM_DIR/alias/default" 2>/dev/null)
[[ -f "$NVM_DIR/alias/$_nvm_default" ]] && _nvm_default=$(<"$NVM_DIR/alias/$_nvm_default")
[[ -d "$NVM_DIR/versions/node/$_nvm_default/bin" ]] && export PATH="$NVM_DIR/versions/node/$_nvm_default/bin:$PATH"
unset _nvm_default
nvm() {
  unset -f nvm
  source "${HOMEBREW_PREFIX:-/usr/local}/opt/nvm/nvm.sh"
  nvm "$@"
}
```
Set the default version with `nvm alias default lts/iron`, then open a new shell.

### Checkout the LTS versions
```shell
nvm ls
```

### Install Nodejs latest version
Node 20v
```shell
nvm install lts/iron
```

### Install pnpm
```shell
npm i -g pnpm
```


### Set up pnpm home
```shell
# pnpm
export PNPM_HOME="/Users/irfan.baig/Library/pnpm"
case ":$PATH:" in
  *":$PNPM_HOME:"*) ;;
  *) export PATH="$PNPM_HOME:$PATH" ;;
esac
# pnpm end
```
