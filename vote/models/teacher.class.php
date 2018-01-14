<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 2018/1/14
 * Time: 15:08
 */
require_once ('vote.class.php');
class TeacherVote extends VoteModel
{
    protected $voted_table = 't_voters';
    protected $vote_list_table = 't_vote_lists';
}