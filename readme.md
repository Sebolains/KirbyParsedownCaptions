# Parsedown Figure Caption Extension for Kirby CMS

This [Kirby CMS](https://getkirby.com/) plugin will extend [Parsedown](http://parsedown.org/) or [Parsedown Extra](https://github.com/erusev/parsedown-extra) (Kirby's [Markdown](https://daringfireball.net/projects/markdown/) parsers) functionality to turn all images into figures with captions. This is done by modifying the way in which images are parsed and wrapping them in `<figure>` tags, while adding either the **title text** or **alt text** fields (in that order of priority) as the figure's caption wrapped in `<figcaption>` tags below the image.

- Requires PHP 5.4.0 or later
- Works only with Markdown images and not with Kirby Text image tags, since the latter will be included in `<figure>` tags by default, while plain Markdown images will not.

## Example

As a simple example, a Markdown source of

```markdown
![alt text](/path/to/img.jpg "image title")
```

Will become

```html
<figure>
    <img src="/path/to/img.jpg" alt="alt text">
	<figcaption>image title</figcaption>
</figure> 
```

Instead of simply

```html
<img src="/path/to/img.jpg" alt="alt text">
```

## Title Text vs Alt Text

The text used for the figure caption will follow the heuristic below:

1. If a title is present, the title will be used as the figure caption.
2. If a title is not present and an alt text is present, the alt text will be used as the figure caption.
3. if neither title not alt text are present, then no caption will be added, but image will still be wrapped in figure tags.

## Installation

To install, simply copy the contents of this repository (or add it as a git submodule) into a subfolder under `site/plugis` called `kirbyparsedowncaptions`.