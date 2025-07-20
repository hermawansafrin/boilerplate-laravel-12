<footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>{{ config('app.description') }}</b>
                </div>
                <strong>Copyright &copy; {{ date('Y') }} <a href="https://github.com/hermawansafrin" target="_blank">{{ config('app.author') }}</a>. </strong>
            </footer>
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        <!-- jQuery -->
        <script src="{{ asset('admin-template') }}/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('admin-template') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

        @stack('before_scripts')

        <!-- AdminLTE App -->
        <script src="{{ asset('admin-template') }}/dist/js/adminlte.min.js"></script>

        @stack('scripts')
    </body>
</html>
