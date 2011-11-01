<h1>The Markdown Syntax</h1>

<p><strong>CriticizeMyCode</strong> allows you to post HTML syntax to format your posts.
However, if HTML is too difficult for you, you can alternatively use the Markdown syntax.
The Markdown syntax is aimed to help simplify code posting without thinking of HTML. 
Just follow some simple syntax and you're good to go.</p>

<h3>Quick navigation</h3>

<ul>
	<li><a href="#posting-codes">Posting codes</a></li>
	<li><a href="#emphasized-texts">Emphasized texts</a></li>
	<li><a href="#bolded-texts">Bolded texts</a></li>
</ul>

<h3 id="posting-codes">Posting codes</h3>

<p>There are two types of codes, <code>inline</code> codes and <code>block</code> codes.</p>

<h4>Inline codes</h4>

<p>Example, if you want to write a very small code (a word or a phrase perhaps), you write
them as inline code. Simply wrap the phrase with backticks (<code>`</code>). See example below:</p>

<pre>Which do you prefer, `&lt;strong&gt;` or `&lt;b&gt;`?</pre>

<p>Which would output:</p>

<blockquote>Which do you prefer, <code>&lt;strong&gt;</code> or <code>&lt;b&gt;</code>?</blockquote>

<h4>Block codes</h4>

<p>To type blocks of code, there are two options:</p>

<ol>
	<li>Indenting each line with 4 spaces</li>
	<li>Wrapping the block of codes with <code>~~~</code></li>
</ol>

<p>Example of indenting lines of code:</p>

<pre>
    $(function(){
        alert("test");
    });
</pre>

<p>Example of wrapping codes with <code>~~~</code>:</p>

<pre>
~~~
$(function(){
    alert("test");
});
~~~
</pre>

<p>Alternatively, you can write the HTML tags <code>&lt;code&gt;</code> and
<code>&lt;pre&gt;</code> if you like.</p>

<h3 id="emphasized-texts">Emphasized texts</h3>

<p>For emphasized texts, usually displayed in <code>italic</code>, wrap the text
or phrase with asterisk <code>*</code> or underscore <code>_</code>. Example:</p>

<pre>
Today is a *great* day! Today is _Monday_!
</pre>

<p>Would ouput:</p>

<blockquote>Today is a <em>great</em> day! Today is <em>Monday</em>!</blockquote>

<h3 id="bolded-texts">Bolded texts</h3>

<p>For bolded texts, wrap the text or phrase with double asterisk <code>**</code>
or underscore <code>__</code>. Example:</p>

<pre>
Today is a **great** day! Today is __Monday__!
</pre>

<p>Would ouput:</p>

<blockquote>Today is a <strong>great</strong> day! Today is <strong>Monday</strong>!</blockquote>