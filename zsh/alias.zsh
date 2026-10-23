
# Example
alias zshconfig="code ~/.zshrc"
alias sourcezsh="source ~/.zshrc"
alias ohmyzsh="code ~/.oh-my-zsh"
alias zalias="cat ~/.zshrc | grep alias"

# Docker
alias dkps="docker ps"
alias dkst="docker stats"
alias dkpsa="docker ps -a"
alias dkimgs="docker images"
alias dcup="docker-compose up -d"
alias dcdown="docker-compose down"
alias dcstart="docker-compose start"
alias dcstop="docker-compose stop"

alias kallnode='sudo pkill -9 node'

# cd
alias ..="cd .."
alias x="exit"
alias sb="source ~/.bash_profile"
alias hc="history -c"


alias pstorm="/usr/local/bin/pstorm"


# git shortcuts
alias undocommit="git reset --soft HEAD~1"
alias undotagr="git push --delete origin $1"
alias destroycommit="git reset --hard HEAD~1"

#node
alias cnodemodules="find . -name "node_modules" -type d -prune -exec rm -rf '{}' +"

# Mac
alias mac.showhidden="defaults write com.apple.finder AppleShowAllFiles TRUE && killall Finder"
alias mac.hidehidden="defaults write com.apple.finder AppleShowAllFiles FALSE && killall Finder"

# tar
alias tarr="tar -pczf $1 $2"
alias untarr="tar -pxzf $1"
alias starr="sudo tar -pczf $1 $2"

# ls
alias ll="ls -AlhG"

# Cleaning
alias clean.node="find . -name "node_modules" -type d -prune -exec rm -rf '{}' +"
alias clean.vendor="rm -rf */vendor/*"
alias clean.devices="xcrun simctl delete all"
