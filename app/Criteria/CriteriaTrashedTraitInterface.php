<?php

namespace CodeEditora\Criteria;

interface CriteriaTrashedTraitInterface{
        public function onlyTrashed();

        public function withTrashed();
    }
