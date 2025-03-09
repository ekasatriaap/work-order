<x-app-layout :title="$title">
    <x-row>
        <div class="col-lg-12">
            <x-card title="Detail dan Manajemen Akses Role {{ $role['name'] }}"
                desc="Menampilkan dan mengelola hak akses role {{ strtolower($role['name']) }}">
                @slot('toolbar')
                    <a href="{{ route($permission_name . '.index') }}" class="btn btn-danger btn-sm"><i
                            class="fas fa-arrow-left"></i>Kembali</a>
                @endslot
                <div id="msg"></div>
                <div id="path"></div>
                <ul class="nav nav-pills mb-3 mt-5">
                    @php
                        $tab = 1;
                    @endphp
                    @foreach ($menuUsers as $key => $menu)
                        <li class="nav-item">
                            <a class=" @if ($tab == 1) active @endif nav-link"
                                id="kt_stats_widget_16_tab_link_{{ $tab }}" data-toggle="pill"
                                href="#kt_vtab_pane_{{ $tab }}">
                                <i class="{{ $menu['icon'] }}"></i>
                                {{ $menu['name'] }}
                            </a>
                        </li>
                        @php
                            $tab++;
                        @endphp
                    @endforeach
                </ul>

                <div class="tab-content" id="myTabContent">
                    @php
                        $tab = 1;
                    @endphp
                    @foreach ($menuUsers as $key => $menu)
                        <div class="tab-pane fade @if ($tab == 1) show active @endif"
                            id="kt_vtab_pane_{{ $tab }}" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="kt_docs_jstree_basic">
                                        <?php echo setupPermissionMenu($menu, $role_permissions, $tab); ?>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <table class="display-permission-{{ $tab }}" cellspacing="0"
                                        cellpadding="0" width="50%">
                                    </table>
                                </div>
                            </div>

                        </div>
                        @php
                            $tab++;
                        @endphp
                    @endforeach
                </div>
            </x-card>
        </div>
    </x-row>

    @push('add-styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    @endpush
    @push('add-scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
        <script>
            const ALL_PERMISSIONS = [];
            let timerSubmitData;

            $(document).ready(function() {
                $('.kt_docs_jstree_basic').jstree({
                    "plugins": ["types"],
                    "core": {
                        "themes": {
                            "responsive": false,
                            "stripes": true
                        },
                    },
                    "types": {
                        "default": {
                            "icon": "fa fa-folder"
                        },
                        "file": {
                            "icon": "fa fa-file"
                        }
                    },
                });

                $(".kt_docs_jstree_basic").on("select_node.jstree", function(event, data) {
                    fnDisplayPermission(data.node);
                });
            });

            function fnDisplayPermission(node) {
                let parent = $(`#${node.id}`).closest('li');
                let label = $(`#${node.id}`).children('a').find('label');
                let display = $(`.display-permission-${parent.data('tab')}`);
                display.empty();

                if (label.length == 0) {
                    return false;
                }

                let title = `<tr><td colspan='2' class='fw-bold'>Hak Akses ${parent.data('name')}</td></tr>`;
                display.append(title);

                label.each(function(index, element) {
                    const ELL = $(element);
                    let text = ELL.data('text'),
                        checked = ELL.attr('checked') ? "checked" : '',
                        elmId = text + new Date().getTime(),
                        alias = ELL.data('alias');

                    display.append(`
                        <tr>
                            <td class="w-150px"><label class="p-0" for="${elmId}">${alias}</label></td>
                            <td><input id="${elmId}" onchange="fnGiveRevokePermission(this)" data-parent="${node.id}" data-text="${text}" type="checkbox" name="${ELL.data('name')}" ${checked}></td>
                        </tr>
                    `);
                });
            }

            function fnGiveRevokePermission(checkbox) {

                let is_checked = $(checkbox).is(":checked"),
                    id = $(checkbox).data('parent'),
                    text = $(checkbox).data("text"),
                    itemJsTree = $(`#${id}`).children('a').find(`label[data-text="${text}"]`);

                itemJsTree.attr('checked', is_checked);
                itemJsTree.empty().append(getPengaturanIconMenu(text, is_checked));

                for (let index = 0; index < ALL_PERMISSIONS.length; index++) {
                    const permission = ALL_PERMISSIONS[index];
                    if (permission.name == name) {
                        ALL_PERMISSIONS.splice(index, 1);
                        break
                    }
                }

                ALL_PERMISSIONS.push({
                    name: $(checkbox).attr("name"),
                    is_checked: (is_checked ? 1 : 0)
                });

                clearTimeout(timerSubmitData);
                timerSubmitData = setTimeout(() => {
                    ajaxGiveRevoke();
                }, 1000);
            }

            function getPengaturanIconMenu($permission, $checked = true) {
                if ($permission == 'lihat') return "<span class='fas fa-eye " + ($checked ? 'text-default' : 'text-secondary') +
                    "'></span>";
                if ($permission == 'tambah') return "<span class='fas fa-plus-circle " + ($checked ? 'text-primary' :
                    'text-secondary') + "'></span>";
                if ($permission == 'ubah') return "<span class='fas fa-edit " + ($checked ? 'text-warning' :
                    'text-secondary') + "'></span>";
                if ($permission == 'hapus') return "<span class='fas fa-trash " + ($checked ? 'text-danger' :
                    'text-secondary') + "'></span>";
                if ($permission == 'detail') return "<span class='fas fa-info-circle " + ($checked ? 'text-info' :
                    'text-secondary') + "'></span>";
                if ($permission == 'sync_feeder') return "<span class='fas fa-sync " + ($checked ? 'text-success' :
                    'text-secondary') + "'></span>";
                if ($permission == 'login') return "<span class='fas fa-lock " + ($checked ? 'text-success' :
                    'text-secondary') + "'></span>";
                return '';
            }

            function ajaxGiveRevoke() {

                return new Promise((resolve, reject) => {
                    if (ALL_PERMISSIONS.length > 0) {

                        let sendData = {
                            permissions: ALL_PERMISSIONS,
                        };

                        ajaxMaster("{{ route('role.permission', $role['id']) }}", "POST", sendData).then((
                            response) => {
                            if (response.success) {
                                iziToast.success({
                                    title: "Sukses..",
                                    message: response.message,
                                    position: "topRight",
                                })
                            } else {
                                iziToast.warning({
                                    title: "Oops..",
                                    message: response.message,
                                    position: "topRight",
                                })
                            }
                            ALL_PERMISSIONS.splice(0, ALL_PERMISSIONS.length);
                        }).catch((err) => {
                            ALL_PERMISSIONS.splice(0, ALL_PERMISSIONS.length);
                            toastr.error(err.statusText, err.status);
                        })
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
