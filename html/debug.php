<?php phpinfo(); ?>
<p>
<pre>
<?php print(shell_exec('/usr/bin/nipper --help | sed -r "s/[[:cntrl:]]\[[0-9]{1,3}m//g"')); ?>
</pre>
</p>
<p>
<pre>
<?php print(shell_exec('/usr/bin/ldd --version')); ?>
</pre>
</p>

