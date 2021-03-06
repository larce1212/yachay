<?php

class Resources_Resource extends Yachay_Model_Row_Validation
{
    protected $_validationRules = array();

    public function getAuthor() {
        $model_users = new Users();
        return $model_users->findByIdent($this->author);
    }

    public function getExtended() {
        $model_notes = new Notes();
        $note = $model_notes->findByResource($this->ident);
        if (!empty($note)) {
            return $note;
        }

        $model_links = new Links();
        $link = $model_links->findByResource($this->ident);
        if (!empty($link)) {
            return $link;
        }

        $model_files = new Files();
        $file = $model_files->findByResource($this->ident);
        if (!empty($file)) {
            return $file;
        }

        $model_events = new Events();
        $event = $model_events->findByResource($this->ident);
        if (!empty($event)) {
            return $event;
        }

        $model_photos = new Photos();
        $photo = $model_photos->findByResource($this->ident);
        if (!empty($photo)) {
            return $photo;
        }

        $model_videos = new Videos();
        $video = $model_videos->findByResource($this->ident);
        if (!empty($video)) {
            return $video;
        }

        $model_feedback = new Feedback();
        $entry = $model_feedback->findByResource($this->ident);
        if (!empty($entry)) {
            return $entry;
        }
    }

    public function amAuthor() {
        $user = Zend_Registry::get('user');
        return ($user->ident == $this->author);
    }

    public function saveContext($request) {
        $publish = $request->getParam('publish');
        list($element, $ident) = @split('-', $publish);

        switch ($element) {
            case 'global':
                $model_global_resource = new Resources_Globales();
                $global_resource = $model_global_resource->createRow();
                $global_resource->resource = $this->ident;
                $global_resource->save();
                break;
            case 'area':
                $model_areas_resource = new Areas_Resources();
                $area_resource = $model_areas_resource->createRow();
                $area_resource->resource = $this->ident;
                $area_resource->area = $ident;
                $area_resource->save();
                break;
            case 'career':
                $model_careers_resource = new Careers_Resources();
                $career_resource = $model_careers_resource->createRow();
                $career_resource->resource = $this->ident;
                $career_resource->career = $ident;
                $career_resource->save();
                break;
            case 'subject':
                $model_subjects_resource = new Subjects_Resources();
                $subject_resource = $model_subjects_resource->createRow();
                $subject_resource->resource = $this->ident;
                $subject_resource->subject = $ident;
                $subject_resource->save();
                break;
            case 'groupset':
                $model_groupsets = new Groupsets();
                $model_groups_resource = new Groups_Resources();
                $groupset = $model_groupsets->findByIdent($ident);
                $groups = $groupset->findGroupsViaGroupsets_Groups();
                foreach ($groups as $group) {
                    $group_resource = $model_groups_resource->createRow();
                    $group_resource->resource = $this->ident;
                    $group_resource->group = $group->ident;
                    $group_resource->save();
                }
                break;
            case 'group':
                $model_groups_resource = new Groups_Resources();
                $group_resource = $model_groups_resource->createRow();
                $group_resource->resource = $this->ident;
                $group_resource->group = $ident;
                $group_resource->save();
                break;
            case 'team':
                $model_teams_resource = new Teams_Resources();
                $team_resource = $model_teams_resource->createRow();
                $team_resource->resource = $this->ident;
                $team_resource->team = $ident;
                $team_resource->save();
                break;
            case 'community':
                $model_communities_resource = new Communities_Resources();
                $community_resource = $model_communities_resource->createRow();
                $community_resource->resource = $this->ident;
                $community_resource->community = $ident;
                $community_resource->save();
            case 'user':
                $model_users_resource = new Users_Resources();
                $user_resource = $model_users_resource->createRow();
                $user_resource->resource = $this->ident;
                $user_resource->user = $ident;
                $user_resource->save();
                break;
        }
    }

    public function delete() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $db->delete('resource_global', '`resource` = ' . $this->ident);
        $db->delete('area_resource', '`resource` = ' . $this->ident);
        $db->delete('subject_resource', '`resource` = ' . $this->ident);
        $db->delete('group_resource', '`resource` = ' . $this->ident);
        $db->delete('team_resource', '`resource` = ' . $this->ident);
        $db->delete('community_resource', '`resource` = ' . $this->ident);
        $db->delete('user_resource', '`resource` = ' . $this->ident);
        parent::delete();
    }
}
