<?php

use Core\Page;

Page::pushFoot("<script src='".asset('assets/assessment/js/performances.js?staging='.strtotime('now'))."'></script>");