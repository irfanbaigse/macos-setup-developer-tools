# ZSH Setup

## Going one word backwards and forwards

![going_forward_backword.png](going_forward_backword.png)

Then, you can

* move a word backwards Option ⌥ + ←
* move a word forwards Option ⌥ + →
* move to the start of the line fn + ←
* move to the end of the line fn + →
* delete a word backwards Option ⌥ + ⌫
* delete the whole line Command ⌘ + ⌫


https://github.com/romkatv/powerlevel10k#configuration

p10k configure

in ~/.zshrc file

```shell
ZSH_THEME="powerlevel10k/powerlevel10k"
```

## Fast shell startup

Measure how long a new shell takes (aim for under 1s):

```shell
for i in 1 2 3; do /usr/bin/time zsh -i -c exit; done
```

### Enable Powerlevel10k instant prompt

Keep this block at the very top of `~/.zshrc`. Anything that prints output (banners, `echo`) must go **above** it:

```shell
if [[ -r "${XDG_CACHE_HOME:-$HOME/.cache}/p10k-instant-prompt-${(%):-%n}.zsh" ]]; then
  source "${XDG_CACHE_HOME:-$HOME/.cache}/p10k-instant-prompt-${(%):-%n}.zsh"
fi
```

In `~/.p10k.zsh`:

```shell
typeset -g POWERLEVEL9K_INSTANT_PROMPT=quiet
```

### Keep the plugin list short

Don't list a plugin twice, and keep `zsh-syntax-highlighting` last:

```shell
plugins=(
    autojump
    git
    docker
    dirhistory
    history
    zsh-autosuggestions
    zsh-syntax-highlighting
)
```

### Cache completion scripts

`eval "$(tool completion zsh)"` runs the tool on every new shell. Generate the script once and source the file instead:

```shell
mkdir -p ~/.cache/zsh
[[ -s ~/.cache/zsh/pip-completion.zsh ]] || pip completion --zsh > ~/.cache/zsh/pip-completion.zsh 2>/dev/null
source ~/.cache/zsh/pip-completion.zsh
```

Delete the cached file to regenerate it after upgrading the tool.

### Lazy-load nvm

Sourcing `nvm.sh` takes about a second. See [Lazy-load nvm](../nodejs/SETUP.md#lazy-load-nvm-faster-shell-startup).

### Avoid command substitution in aliases

Backticks or `$(...)` inside a double-quoted alias run when the shell starts, not when the alias is used. Use single quotes:

```shell
alias kallnode='sudo pkill -9 node'
```



