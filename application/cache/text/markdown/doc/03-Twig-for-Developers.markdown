<h1>Twig for Developers</h1>

<p>This chapter describes the API to Twig and not the template language. It will
be most useful as reference to those implementing the template interface to
the application and not those who are creating Twig templates.</p>

<h2>Basics</h2>

<p>Twig uses a central object called the <strong>environment</strong> (of class
<code>Twig_Environment</code>). Instances of this class are used to store the
configuration and extensions, and are used to load templates from the file
system or other locations.</p>

<p>Most applications will create one <code>Twig_Environment</code> object on application
initialization and use that to load templates. In some cases it's however
useful to have multiple environments side by side, if different configurations
are in use.</p>

<p>The simplest way to configure Twig to load templates for your application
looks roughly like this:</p>

<pre><code>[php]
require_once '/path/to/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('/path/to/templates');
$twig = new Twig_Environment($loader, array(
  'cache' =&gt; '/path/to/compilation_cache',
));
</code></pre>

<p>This will create a template environment with the default settings and a loader
that looks up the templates in the <code>/path/to/templates/</code> folder. Different
loaders are available and you can also write your own if you want to load
templates from a database or other resources.</p>

<blockquote>
  <p><strong>CAUTION</strong>
  Before Twig 0.9.3, the <code>cache</code> option did not exist, and the cache directory
  was passed as a second argument of the loader.</p>
</blockquote>

<p>-</p>

<blockquote>
  <p><strong>NOTE</strong>
  Notice that the second argument of the environment is an array of options.
  The <code>cache</code> option is a compilation cache directory, where Twig caches the
  compiled templates to avoid the parsing phase for sub-sequent requests. It
  is very different from the cache you might want to add for the evaluated
  templates. For such a need, you can use any available PHP cache library.</p>
</blockquote>

<p>To load a template from this environment you just have to call the
<code>loadTemplate()</code> method which then returns a <code>Twig_Template</code> instance:</p>

<pre><code>[php]
$template = $twig-&gt;loadTemplate('index.html');
</code></pre>

<p>To render the template with some variables, call the <code>render()</code> method:</p>

<pre><code>[php]
echo $template-&gt;render(array('the' =&gt; 'variables', 'go' =&gt; 'here'));
</code></pre>

<blockquote>
  <p><strong>NOTE</strong>
  The <code>display()</code> method is a shortcut to output the template directly.</p>
</blockquote>

<h2>Environment Options</h2>

<p>When creating a new <code>Twig_Environment</code> instance, you can pass an array of
options as the constructor second argument:</p>

<pre><code>[php]
$twig = new Twig_Environment($loader, array('debug' =&gt; true));
</code></pre>

<p>The following options are available:</p>

<ul>
<li><p><code>debug</code>: When set to <code>true</code>, the generated templates have a <code>__toString()</code>
method that you can use to display the generated nodes (default to
<code>false</code>).</p></li>
<li><p><code>trim_blocks</code>: Mimicks the behavior of PHP by removing the newline that
follows instructions if present (default to <code>false</code>).</p></li>
<li><p><code>charset</code>: The charset used by the templates (default to <code>utf-8</code>).</p></li>
<li><p><code>base_template_class</code>: The base template class to use for generated
templates (default to <code>Twig_Template</code>).</p></li>
<li><p><code>cache</code>: An absolute path where to store the compiled templates, or false
to disable caching (which is the default).</p></li>
<li><p><code>auto_reload</code>: When developing with Twig, it's useful to recompile the
template whenever the source code changes. If you don't provide a value for
the <code>auto_reload</code> option, it will be determined automatically based on the
<code>debug</code> value.</p></li>
<li><p><code>strict_variables</code> (new in Twig 0.9.7): If set to <code>false</code>, Twig will
silently ignore invalid variables (variables and or attributes/methods that
do not exist) and replace them with a <code>null</code> value. When set to <code>true</code>,
Twig throws an exception instead (default to <code>false</code>).</p></li>
</ul>

<blockquote>
  <p><strong>CAUTION</strong>
  Before Twig 0.9.3, the <code>cache</code> and <code>auto_reload</code> options did not exist. They
  were passed as a second and third arguments of the filesystem loader
  respectively.</p>
</blockquote>

<h2>Loaders</h2>

<blockquote>
  <p><strong>CAUTION</strong>
  This section describes the loaders as implemented in Twig version 0.9.4 and
  above.</p>
</blockquote>

<p>Loaders are responsible for loading templates from a resource such as the file
system.</p>

<h3>Compilation Cache</h3>

<p>All template loaders can cache the compiled templates on the filesystem for
future reuse. It speeds up Twig a lot as templates are only compiled once;
and the performance boost is even larger if you use a PHP accelerator such as
APC. See the <code>cache</code> and <code>auto_reload</code> options of <code>Twig_Environment</code> above for
more information.</p>

<h3>Built-in Loaders</h3>

<p>Here is a list of the built-in loaders Twig provides:</p>

<ul>
<li><p><code>Twig_Loader_Filesystem</code>: Loads templates from the file system. This loader
can find templates in folders on the file system and is the preferred way
to load them.</p>

<pre><code>[php]
$loader = new Twig_Loader_Filesystem($templateDir);
</code></pre>

<p>It can also look for templates in an array of directories:</p>

<pre><code>[php]
$loader = new Twig_Loader_Filesystem(array($templateDir1, $templateDir2));
</code></pre>

<p>With such a configuration, Twig will first look for templates in
<code>$templateDir1</code> and if they do not exist, it will fallback to look for them
in the <code>$templateDir2</code>.</p></li>
<li><p><code>Twig_Loader_String</code>: Loads templates from a string. It's a dummy loader as
you pass it the source code directly.</p>

<pre><code>[php]
$loader = new Twig_Loader_String();
</code></pre></li>
<li><p><code>Twig_Loader_Array</code>: Loads a template from a PHP array. It's passed an
array of strings bound to template names. This loader is useful for unit
testing.</p>

<pre><code>[php]
$loader = new Twig_Loader_Array($templates);
</code></pre></li>
</ul>

<blockquote>
  <p><strong>TIP</strong>
  When using the <code>Array</code> or <code>String</code> loaders with a cache mechanism, you should
  know that a new cache key is generated each time a template content "changes"
  (the cache key being the source code of the template). If you don't want to
  see your cache grows out of control, you need to take care of clearing the old
  cache file by yourself.</p>
</blockquote>

<h3>Create your own Loader</h3>

<p>All loaders implement the <code>Twig_LoaderInterface</code>:</p>

<pre><code>[php]
interface Twig_LoaderInterface
{
  /**
   * Gets the source code of a template, given its name.
   *
   * @param  string $name string The name of the template to load
   *
   * @return string The template source code
   */
  public function getSource($name);

  /**
   * Gets the cache key to use for the cache for a given template name.
   *
   * @param  string $name string The name of the template to load
   *
   * @return string The cache key
   */
  public function getCacheKey($name);

  /**
   * Returns true if the template is still fresh.
   *
   * @param string    $name The template name
   * @param timestamp $time The last modification time of the cached template
   */
  public function isFresh($name, $time);
}
</code></pre>

<p>As an example, here is how the built-in <code>Twig_Loader_String</code> reads:</p>

<pre><code>[php]
class Twig_Loader_String implements Twig_LoaderInterface
{
  public function getSource($name)
  {
    return $name;
  }

  public function getCacheKey($name)
  {
    return $name;
  }

  public function isFresh($name, $time)
  {
    return false;
  }
}
</code></pre>

<p>The <code>isFresh()</code> method must return <code>true</code> if the current cached template is
still fresh, given the last modification time, or <code>false</code> otherwise.</p>

<h2>Using Extensions</h2>

<p>Twig extensions are packages that adds new features to Twig. Using an
extension is as simple as using the <code>addExtension()</code> method:</p>

<pre><code>[php]
$twig-&gt;addExtension(new Twig_Extension_Escaper());
</code></pre>

<p>Twig comes bundled with four extensions:</p>

<ul>
<li><p><em>Twig<em>Extension</em>Core</em>: Defines all the core features of Twig and is automatically
registered when you create a new environment.</p></li>
<li><p><em>Twig<em>Extension</em>Escaper</em>: Adds automatic output-escaping and the possibility to
escape/unescape blocks of code.</p></li>
<li><p><em>Twig<em>Extension</em>Sandbox</em>: Adds a sandbox mode to the default Twig environment, making it
safe to evaluated untrusted code.</p></li>
<li><p><em>Twig<em>Extension</em>I18n</em>: Adds internationalization support via the gettext library.</p></li>
</ul>

<h2>Built-in Extensions</h2>

<p>This section describes the features added by the built-in extensions.</p>

<blockquote>
  <p><strong>TIP</strong>
  Read the chapter about extending Twig to learn how to create your own
  extensions.</p>
</blockquote>

<h3>Core Extension</h3>

<p>The <code>core</code> extension defines all the core features of Twig:</p>

<ul>
<li><p>Tags:</p>

<ul>
<li><code>for</code></li>
<li><code>if</code></li>
<li><code>extends</code></li>
<li><code>include</code></li>
<li><code>block</code></li>
<li><code>parent</code></li>
<li><code>display</code></li>
<li><code>filter</code></li>
<li><code>macro</code></li>
<li><code>import</code></li>
<li><code>set</code></li>
</ul></li>
<li><p>Filters:</p>

<ul>
<li><code>date</code></li>
<li><code>format</code></li>
<li><code>even</code></li>
<li><code>odd</code></li>
<li><code>urlencode</code></li>
<li><code>title</code></li>
<li><code>capitalize</code></li>
<li><code>upper</code></li>
<li><code>lower</code></li>
<li><code>striptags</code></li>
<li><code>join</code></li>
<li><code>reverse</code></li>
<li><code>length</code></li>
<li><code>sort</code></li>
<li><code>in</code></li>
<li><code>range</code></li>
<li><code>cycle</code></li>
<li><code>default</code></li>
<li><code>keys</code></li>
<li><code>items</code></li>
<li><code>escape</code></li>
<li><code>e</code></li>
</ul></li>
</ul>

<p>The core extension does not need to be added to the Twig environment, as it is
registered by default.</p>

<h3>Escaper Extension</h3>

<p>The <code>escaper</code> extension adds automatic output escaping to Twig. It defines a
new tag, <code>autoescape</code>, and a new filter, <code>raw</code>.</p>

<p>When creating the escaper extension, you can switch on or off the global
output escaping strategy:</p>

<pre><code>[php]
$escaper = new Twig_Extension_Escaper(true);
$twig-&gt;addExtension($escaper);
</code></pre>

<p>If set to <code>true</code>, all variables in templates are escaped, except those using
the <code>raw</code> filter:</p>

<pre><code>[twig]
{{ article.to_html|raw }}
</code></pre>

<p>You can also change the escaping mode locally by using the <code>autoescape</code> tag:</p>

<pre><code>[twig]
{% autoescape on %}
  {% var %}
  {% var|raw %}     {# var won't be escaped #}
  {% var|escape %}   {# var won't be doubled-escaped #}
{% endautoescape %}
</code></pre>

<blockquote>
  <p><strong>WARNING</strong>
  The <code>autoescape</code> tag has no effect on included files.</p>
</blockquote>

<p>The escaping rules are implemented as follows (it describes the behavior of
Twig 0.9.9 and above):</p>

<ul>
<li><p>Literals (integers, booleans, arrays, ...) used in the template directly as
variables or filter arguments are never automatically escaped:</p>

<pre><code>[twig]
{{ "Twig&lt;br /&gt;" }} {# won't be escaped #}

{% set text = "Twig&lt;br /&gt;" %}
{{ text }} {# will be escaped #}
</code></pre></li>
<li><p>Expressions which the result is always a literal or a variable marked safe
are never automatically escaped:</p>

<pre><code>[twig]
{{ foo ? "Twig&lt;br /&gt;" : "&lt;br /&gt;Twig" }} {# won't be escaped #}

{% set text = "Twig&lt;br /&gt;" %}
{{ foo ? text : "&lt;br /&gt;Twig" }} {# will be escaped #}

{% set text = "Twig&lt;br /&gt;" %}
{{ foo ? text|raw : "&lt;br /&gt;Twig" }} {# won't be escaped #}

{% set text = "Twig&lt;br /&gt;" %}
{{ foo ? text|escape : "&lt;br /&gt;Twig" }} {# the result of the expression won't be escaped #}
</code></pre></li>
<li><p>Escaping is applied before printing, after any other filter is applied:</p>

<pre><code>[twig]
{{ var|upper }} {# is equivalent to {{ var|upper|escape }} #}
</code></pre></li>
<li><p>The <code>raw</code> filter should only be used at the end of the filter chain:</p>

<pre><code>[twig]
{{ var|raw|upper }} {# will be escaped #}

[twig]
{{ var|upper|raw }} {# won't be escaped #}
</code></pre></li>
<li><p>Automatic escaping is not applied if the last filter in the chain is marked
safe for the current context (e.g. <code>html</code> or <code>js</code>). <code>escaper</code> and
<code>escaper('html')</code> are marked safe for html, <code>escaper('js')</code> is marked safe
for javascript, <code>raw</code> is marked safe for everything.</p>

<pre><code>[twig]
{% autoescape js on %}
{{ var|escape('html') }} {# will be escaped for html and javascript #}
{{ var }} {# will be escaped for javascript #}
{{ var|escape('js') }} {# won't be double-escaped #}
{% endautoescape %}
</code></pre></li>
</ul>

<h3>Sandbox Extension</h3>

<p>The <code>sandbox</code> extension can be used to evaluate untrusted code. Access to
unsafe attributes and methods is prohibited. The sandbox security is managed
by a policy instance. By default, Twig comes with one policy class:
<code>Twig_Sandbox_SecurityPolicy</code>. This class allows you to white-list some tags,
filters, properties, and methods:</p>

<pre><code>[php]
$tags = array('if');
$filters = array('upper');
$methods = array(
  'Article' =&gt; array('getTitle', 'getBody'),
);
$properties = array(
  'Article' =&gt; array('title', 'body),
);
$policy = new Twig_Sandbox_SecurityPolicy($tags, $filters, $methods, $properties);
</code></pre>

<p>With the previous configuration, the security policy will only allow usage of
the <code>if</code> tag, and the <code>upper</code> filter. Moreover, the templates will only be
able to call the <code>getTitle()</code> and <code>getBody()</code> methods on <code>Article</code> objects,
and the <code>title</code> and <code>body</code> public properties. Everything else won't be allowed
and will generate a <code>Twig_Sandbox_SecurityError</code> exception.</p>

<p>The policy object is the first argument of the sandbox constructor:</p>

<pre><code>[php]
$sandbox = new Twig_Extension_Sandbox($policy);
$twig-&gt;addExtension($sandbox);
</code></pre>

<p>By default, the sandbox mode is disabled and should be enabled when including
untrusted template code by using the <code>sandbox</code> tag:</p>

<pre><code>[twig]
{% sandbox %}
  {% include 'user.html' %}
{% endsandbox %}
</code></pre>

<p>You can sandbox all templates by passing <code>true</code> as the second argument of the
extension constructor:</p>

<pre><code>[php]
$sandbox = new Twig_Extension_Sandbox($policy, true);
</code></pre>

<h3>I18n Extension</h3>

<p>The <code>i18n</code> extension adds <a href="http://www.php.net/gettext">gettext</a> support to
Twig. It defines one tag, <code>trans</code>.</p>

<p>You need to register this extension before using the <code>trans</code> block:</p>

<pre><code>[php]
$twig-&gt;addExtension(new Twig_Extension_I18n());
</code></pre>

<p>Note that you must configure the gettext extension before rendering any
internationalized template. Here is a simple configuration example from the
PHP <a href="http://fr.php.net/manual/en/function.gettext.php">documentation</a>:</p>

<pre><code>[php]
// Set language to French
putenv('LC_ALL=fr_FR');
setlocale(LC_ALL, 'fr_FR');

// Specify the location of the translation tables
bindtextdomain('myAppPhp', 'includes/locale');
bind_textdomain_codeset('myAppPhp', 'UTF-8');

// Choose domain
textdomain('myAppPhp');
</code></pre>

<blockquote>
  <p><strong>NOTE</strong>
  The chapter "Twig for Web Designers" contains more information about how to
  use the <code>trans</code> block in your templates.</p>
</blockquote>

<h2>Exceptions</h2>

<p>Twig can throw exceptions:</p>

<ul>
<li><p><code>Twig_Error</code>: The base exception for all template errors.</p></li>
<li><p><code>Twig_SyntaxError</code>: Thrown to tell the user that there is a problem with
the template syntax.</p></li>
<li><p><code>Twig_RuntimeError</code>: Thrown when an error occurs at runtime (when a filter
does not exist for instance).</p></li>
<li><p><code>Twig_Sandbox_SecurityError</code>: Thrown when an unallowed tag, filter, or
method is called in a sandboxed template.</p></li>
</ul>
