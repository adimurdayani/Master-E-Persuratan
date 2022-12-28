<?php
function check_users_aktif($active)
{
    $ci = get_instance();
    $ci->db->where('active', $active);
    $result = $ci->db->get('users')->row();

    if ($result->active == "1") {
        return "checked='checked'";
    }
}

function check_users_groups($group_id)
{
    $ci = get_instance();
    $ci->db->where('group_id', $group_id);
    $result = $ci->db->get('users_groups')->result();

    foreach ($result as $get) {
        if ($get->group_id == 1) {
            return "checked='checked' disabled";
        } else {
            return "checked='checked'";
        }
    }
}

function check_menu_aktif($active)
{
    $ci = get_instance();
    $ci->db->where('active', $active);
    $result = $ci->db->get('menu')->row();

    if ($result->active == "1") {
        return "checked='checked'";
    }
}

function check_collapse_menu($collapse)
{
    $ci = get_instance();
    $ci->db->where('dropdown_active', $collapse);
    $result = $ci->db->get('menu')->row();

    if ($result->dropdown_active == "1") {
        return "checked='checked'";
    }
}


function check_collapse_menu_button($collapse)
{
    $ci = get_instance();
    $ci->db->where('dropdown_active', $collapse);
    $result = $ci->db->get('menu')->row();

    if ($result->dropdown_active == 0) {
        return "hidden='hidden'";
    }
}

function check_akses_menu_group($id_grup, $id_menu_group)
{
    $ci = get_instance();
    $ci->db->where('id_groups', $id_grup);
    $ci->db->where('id_menu_groups', $id_menu_group);
    $result = $ci->db->get('menu_access');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function check_disposisi($status_disposisi)
{
    $ci = get_instance();
    $ci->db->where('status_disposisi', $status_disposisi);
    $result = $ci->db->get('tb_surat_masuk')->row();

    if ($result->status_disposisi > 0) {
        return "checked='checked'";
    }
}

function check_active_disposisi($status_disposisi)
{
    $ci = get_instance();
    $ci->db->where('status_disposisi', $status_disposisi);
    $result = $ci->db->get('tb_surat_masuk')->row();

    if ($result->status_disposisi > 0) {
        return "hidden='hidden'";
    }
}

function check_verifikasi($status_verifikasi)
{
    $ci = get_instance();
    $ci->db->where('status_verifikasi', $status_verifikasi);
    $result = $ci->db->get('tb_surat_masuk')->row();

    if ($result->status_verifikasi > 0) {
        return "checked='checked'";
    }
}

function check_verifikasi_keluar($status_verifikasi)
{
    $ci = get_instance();
    $ci->db->where('status_verifikasi', $status_verifikasi);
    $result = $ci->db->get('tb_surat_keluar')->row();

    if ($result->status_verifikasi > 0) {
        return "checked='checked'";
    }
}
