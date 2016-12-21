@servers(['web' => 'root@45.55.118.102'])

@task('arw', ['on' => 'web'])
    cd /home/admin/web/innernaut.net/public_html
    ls -la
@endtask