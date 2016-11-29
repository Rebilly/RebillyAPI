## Plugins Folder

This folder contains post-process plugins that are run just after bundle.
Check out `x-rebillyMerge.js` plugin for reference.


## Available Plugins

### x-rebillyMerge
Inline references and merge all subschemas using [JSON Merge Patch](https://tools.ietf.org/html/rfc7386)
##### Usage:

```yaml
  x-rebillyMerge:
    - $ref: '#/parameters/someParam'
    - enum:
        - aaa
        - bbb
```
