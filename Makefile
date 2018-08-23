.RECIPEPREFIX +=
.DEFAULT_GOAL := help
.PHONY: $(MAKECMDGOALS)

COLOR_RESET = \033[0m
COLOR_ERROR = \033[31m
COLOR_INFO = \033[32m
COLOR_COMMENT = \033[33m
COLOR_TITLE_BLOCK  = \033[0;44m\033[37m
PROJECT = "Enumerable"

## test sources
test:
    php vendor/bin/phpunit -d memory_limit=512M -v tests

## fix sources
fix:
    php vendor/bin/php-cs-fixer fix src --allow-risky=yes
    php vendor/bin/php-cs-fixer fix tests --allow-risky=yes

## List available commands
help:
    @printf "${COLOR_TITLE_BLOCK}${PROJECT} Makefile${COLOR_RESET}\n"
    @printf "\n"
    @printf "${COLOR_COMMENT}Usage:${COLOR_RESET}\n"
    @printf " make [target] [arg=\"val\"...]\n\n"
    @printf "${COLOR_COMMENT}Available targets:${COLOR_RESET}\n"
    @awk '/^[a-zA-Z\-\_0-9\@]+:/ { \
        helpLine = match(lastLine, /^## (.*)/); \
        helpCommand = substr($$1, 0, index($$1, ":")); \
        helpMessage = substr(lastLine, RSTART + 3, RLENGTH); \
        printf " ${COLOR_INFO}%-20s${COLOR_RESET} %s\n", helpCommand, helpMessage; \
    } \
    { lastLine = $$0 }' $(MAKEFILE_LIST)
