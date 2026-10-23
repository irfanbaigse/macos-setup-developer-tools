# Jenkins Deploy Remote Branch

Triggers the `backend/staging/<project>` Jenkins job for the git tag checked out in the current directory.

## Create an API token

In Jenkins: **your name (top right) → Configure → API Token → Add new Token**.

Requests authenticated with an API token don't need a `Jenkins-Crumb`, so there's no crumb to fetch.

## Set credentials

Keep these out of the script and out of git. For example, in `~/.zshrc` or a password manager CLI:

```shell
export JENKINS_URL="https://jenkins.example.com"
export JENKINS_USER="<user>"
export JENKINS_TOKEN="<token>"
```

## Run in Directory

```shell
php deploy.php [branch] [project]
```

`project` defaults to the current directory name. The script exits non-zero if the tag is missing or Jenkins returns an error.
