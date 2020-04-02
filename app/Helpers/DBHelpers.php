<?php

    function table_exists($table) {
        if (Schema::hasTable($table)) {
            return true;
        }

        return false;
    }