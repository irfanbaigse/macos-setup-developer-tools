<strong>Preface:</strong> We'll use jEnv to deal with Java, its purpose is to manage multiple Java versions in the same machine since projects' Java versions varies.

### Install jEnv
brew install jenv

### Add jEnv config to the Shell (Zsh)
echo 'export PATH="$HOME/.jenv/bin:$PATH"' >> ~/.zshrc
<br>echo 'eval "$(jenv init -)"' >> ~/.zshrc

### Refresh current terminal
source ~/.zshrc

### Enable jEnv to Change JAVA_HOME
jenv enable-plugin export

### Install Needed Java (Temurin) Versions 
brew install --cask temurin@8
<br>brew install --cask temurin
<br>brew install --cask temurin@21

### Add Java Versions to jEnv
jenv add /Library/Java/JavaVirtualMachines/temurin-8.jdk/Contents/Home/
<br>jenv add /Library/Java/JavaVirtualMachines/temurin-17.jdk/Contents/Home/
<br>jenv add /Library/Java/JavaVirtualMachines/temurin-17.jdk/Contents/Home/

### List all registered versions
jenv versions

### Set Java 8 as your global default
jenv global 1.8
<br><br><strong>Note:</strong> Previous command changes your system's Java version, <version> should be one of the "jenv versions"

### Verify the change
java -version
<br>echo $JAVA_HOME
<br><br><strong>Note:</strong> Both Java version and $JAVA_HOME should have the same value you chose in "jenv global" command, try changing it and verify.
