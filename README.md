---
title: Efefefomatic - the Flat File CMS
h1: Welcome to Efefomatic
description: Efefomatic is a flat file CMS offering customizable markdown, templates and YAML front-matter. No dependencies or frameworks.  Just a single file and a simple install.
author: JWRR
date: January 13, 2019
theme: a
...

# Efefomatic
## Description
Efefomatic is a Flat File CMS providing:

* A useful subset of markdown plus a few nice features such as a KBD shortcut 
* Templates with variable syntax similar to twig and liquid,  &lbrace;&lbrace; var &rbrace;&rbrace;
* YAML defines front matter such as Title, Author, date, theme...

Written in the proud spirit of the [Bass o Matic 76](https://www.youtube.com/watch?v=2HKTx5WFcs0),
blending content and themes just the way you like it.

---

{{ toc }}

<ul><li> <a href="#license">License</a>
<li> <a href="#pronounciation">Pronounciation</a>
<li> <a href="#markdown">Markdown</a>
<li> <a href="#extending-markdown">Extending Markdown</a>
<li> <a href="#frameworks">Frameworks and Dependencies</a>
<li> <a href="#00">OO</a>
<li> <a href="#install">Installation</a>
<li> <a href="#examples">Examples</a>
<li> <a href="#tbd">Limitations, Bugs and Issues</a>
<li> <a href="#view-markdown">View Markdown</a></ul>

<a name="license"></a>
## License
MIT License

<a name="pronounciation"></a>
## Pronounciation
It's pronounced just like it's spelt.\
EFF EFF OH MATIC

<a name="markdown"></a>
## Markdown

* H1 &num;
* H2 &num;&num;
* H3 &num;&num;&num;
* H4 &num;&num;&num;&num;
* H5 &num;&num;&num;&num;&num;
* H6 &num;&num;&num;&num;&num;&num;
* HR &lowbar;&lowbar;&lowbar; or &hyphen;&hyphen;&hyphen; or &ast;&ast;&ast;
* BR two spaces at end of line or back-tick at end of line
* LI &ast; at start of line
* UL blank line before the first &ast; list item
* &bsol;UL blank line afer the last &ast; list item
* B  &ast;&ast;text&ast;&ast;
* I  &ast;text&ast;
* CODE three back-ticks (&grave;&grave;&grave;) before and after the code section
* P  One or more blank lines before the text
* A &lbrack;text&rbrack;&lpar;link&rpar;

<a name="markdown-enhancements"></a>
## Markdown Enhancements

* KBD &grave;k&apos;keystroke for a single keystroke
* KBD &grave;k&apos;modifier+keystroke for a two-stroke sequence

<a name="extending-markdown"></a>
## Extending Markdown

You to easily add new, custom markdown features.  At the top of efefomatic.php 
is an array of regular expressions. You can add more regular expressions here
or directly in your application.

The following example simplifies the HTML KBD keystroke sequence. It converts
the sequence <b>`k&apos;keystroke</b> to 
<b>&lt;kbd>keystroke&lt;/kbd></b>. Note, there is no magic associate with the
back-tick or single-quote.  I just chose them because the sequence is unlikely
to collide with other markdown features. You can choose whatever you want when 
you add features.

```
$efef_md[] = array( 'name' => 'kbd', 'from' => "/`k&apos;(.+?)\s/s" , 'to' => "&lt;kbd>&#36;1&lt;/kbd>");
```
The following example is a little more complex and handles a keystroke
combination. It converts the sequence 
<b>`k&apos;modifier+keystroke</b> to
<b>&lt;kbd>modifier&lt;/kbd>+&lt;kbd>keystroke&lt;/kbd></b>.

The [Lua Text Editor Documentation](http://jwrr.com/blog/lua-text-editor) shows
this feature in action.

```
$efef_md[] = array( 'name' => 'kbd2', 'from' => "/`k&apos;(.+?)\+(.+?)&apos;/s" , 'to' => "&lt;kbd>&#36;1&lt;/kbd>+&lt;kbd>&#36;2&lt;/kbd>");
```

<a name="frameworks"></a>
## Frameworks and Dependencies
What's a framework?  
Efefomatic is one PHP file. One file to rule them all.

<a name="00"></a>
## OO
No thanks, I don't need the OO.
[OO on stackexchange](https://travel.stackexchange.com/questions/71995/why-is-this-bathroom-symbol-in-germany-00)

<a name="install"></a>
## Installation

```
git clone https://github.com/jwrr/efefomatic.git
cp -rf efefomatic/example name-of-new-post
cd name-of-new-post
Add markdown file(s).
```
<a name="examples"></a>
## Examples

* This [README.md](http://jwrr.com/blog/efefomatic)
* [My blog](http://jwrr.com/blog)
* Try it, You'll like it. Send me your link and I might post it here

<a name="tbd"></a>
## Limitations, Bugs and Issues
Oh yeah. There be bugs... but it's good enough for me.
___

<a name="view-markdown"></a>
## View Markdown
[View Markdown](README.md)
