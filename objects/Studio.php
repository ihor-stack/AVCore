<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'autoload.php';

if (empty($global['systemRootPath'])) {
    $global['systemRootPath'] = '../';
}
require_once $global['systemRootPath'] . 'videos/configuration.php';

class Studio {
    public function __construct() {

    }

    public static function getOptions($activeOnly = true) {
        global $global;
        $sql = "SELECT id, channelName, externalOptions "
                . " FROM users "
                . " WHERE externalOptions != '' ";
        if ($activeOnly) {
            $sql .= " AND status = 'a' ";
        }
        $res = sqlDAL::readSql($sql);
        $fullResult = sqlDAL::fetchAllAssoc($res);
        sqlDAL::close($res);
        $options = array();
        if ($res != false) {
            foreach ($fullResult as $row) {
                if (!empty($row['externalOptions'])) {
                    $externalOptions = unserialize(base64_decode($row['externalOptions']));
                    $opt = "checkmark3";
                    if (isset($externalOptions[$opt]) && $externalOptions[$opt] == "true") {
                        $options[] = '<option value="' . htmlspecialchars($row['id']) . '">' . 
                            htmlspecialchars($row['channelName']) . '</option>';
                    }
                }
            }
        } else {
            $options = false;
            die($sql . '\nError : (' . $global['mysqli']->errno . ') ' . $global['mysqli']->error);
        }
        return $options;
    }
}