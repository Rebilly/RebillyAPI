# Rebilly REST OpenAPI Specification
[![Build Status](https://travis-ci.org/Rebilly/RebillyAPI.svg?branch=master)](https://travis-ci.org/Rebilly/RebillyAPI)

## Links

- [Documentation (ReDoc)](https://rebilly.github.io/RebillyAPI/)
- OpenAPI Raw Files: [openapi.json](https://rebilly.github.io/RebillyAPI/openapi.json), [openapi.yaml](https://rebilly.github.io/RebillyAPI/openapi.yaml)
- Documentation preview for branch `[branch]`: https://rebilly.github.io/RebillyAPI/preview/[branch]

**Warning:** All the links above are updated only after Travis CI finishes deployment

## Working on specification
### Install

1. Install [Node JS](https://nodejs.org/)
2. Clone repo and run `yarn install` in the repo root

### Usage

#### `yarn start`
Starts the development server.
 #### `yarn build`
Bundles the spec and prepares web_deploy folder with static assets.
 #### `yarn test`
Validates the spec.
 #### `yarn gh-pages`
Deploys docs to GitHub Pages. You don't need to run it manually if you have Travis CI configured.
