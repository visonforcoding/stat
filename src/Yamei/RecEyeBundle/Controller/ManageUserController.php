<?php

namespace Yamei\RecEyeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request as syr;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Yamei\UserBundle\Entity\User;

class ManageUserController extends Controller {

    public function manageAction() {
        return $this->render('YameiRecEyeBundle::manageUser.html.twig');
    }

    public function getUserListAction(syr $request) {
        $searchField = $request->get('searchField');
        $searchOper = $request->get('searchOper');
        $searchString = $request->get('searchString');
        $search = $request->get('_search');
        $countSqlQuery = "select COUNT(*) as count from ym_user ymu";
        $dataSqlQuery = "select ymu.* from `ym_user` ymu ";
//        var_dump($searchOper);
//        $arr =  array(
//            'eq' =>'2'
//        );
//        var_dump($arr[$searchOper]);
//        exit();
        if ($search == 'true') {
            $where = ' where ' . $this->createSqlWhere($searchField, $searchString, $searchOper);  //notic the where space
            $countSqlQuery .= $where;
            $dataSqlQuery .= $where;
        }
        $output = $this->get('yamei_jqgrid')
                ->buildResponse($request, $countSqlQuery, $dataSqlQuery, true, false);
        return new JsonResponse($output);
    }

    public function editUserAction(syr $request) {
        $em = $this->getDoctrine()->getManager();
        $error = false;
        $id = $request->get('id');
        $username = $request->get('username');
        $email = $request->get('email');
        $company = $request->get('company');
        $fullname = $request->get('fullname');
        $enabled = $request->get('enabled');
//            $oper = $request->get('oper');
        if (empty($id) || !is_numeric($id)) {
            $error = true;
        } else {
            $user = $em->getRepository("YameiUserBundle:User")->find($id);
            if (!$user) {
                $error = true;
            } else {
                $user->setUsername($username);
                $user->setEmail($email);
                $user->setCompany($company);
                $user->setFullname($fullname);
                $updTime = date('Y-m-d H:i:s');
                $user->setUpdTime($updTime);
                $user->setEnabled($enabled);

                $em->flush();
                if (!$user->getId()) {
                    $error = true;
                }
            }
        }

        if (!$error) {
            $output['success'] = true;
            $output['message'] = "更新成功！";
        } else {
            $output['success'] = false;
            $output['message'] = "更新失败！";
        }
        return new JsonResponse($output);
    }

    /**
     * delete user 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function delUserAction(syr $request) {
        $em = $this->getDoctrine()->getManager();
        $ids = array_map('trim', explode(',', $request->get('id')));
        $error = false;
        if (empty($ids)) {
            $error = true;
        } else {
            foreach ($ids as $id) {
                $user = $em->getRepository('YameiUserBundle:User')->find($id);
                if ($user) {
                    $em->remove($user);
                    $em->flush();
                    if ($user->getId()) {
                        $error = true;
                    }
                } else {
                    $error = false;
                }
            }
        }
        if (!$error) {
            $output['success'] = true;
            $output['message'] = "删除成功";
        } else {
            $output['success'] = false;
            $output['message'] = "删除失败";
        }

        return new JsonResponse($output);
    }

    /**
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function addUserAction(syr $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();     //creating a QueryBuilder instance
       //$id = $request->get('id');
        $username = $request->get('username');
        $email = $request->get('email');
        $password = $request->get('password');
        $password = sha1($password);
        $company = $request->get('company');
        $fullname = $request->get('fullname');
        $enabled = $request->get('enabled');
        $user = new User();
        $qb->select('ymu')
                ->from('YameiUserBundle:User', 'ymu')
                ->where("ymu.username = '$username'")
                ->orWhere("ymu.email = '$email'");
        $query = $qb->getQuery();
        $count = $query->getResult();
        $count = count($count);
        if (!$count > 0) {
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setCompany($company);
            $user->setPassword($password);
            $user->setFullname($fullname);
            $user->setEnabled($enabled);
            $createTime = date('Y-m-d H:i:s');
            $user->setCrtTime($createTime);
            $em->persist($user);
            $em->flush();
            if (!$user->getId()) {
                $output['success'] = false;
                $output['message'] = "添加成功！";
            } else {
                $output['success'] = true;
                $output['message'] = "添加失败！";
            }
        } else {
            $output['success'] = false;
            $output['message'] = "用户名或邮箱已经存在！";
        }
        return new JsonResponse($output);
    }

    public function chPwdAction(syr $request) {
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');
        $password = $request->get('pwd');
        $updTime = date('Y-m-d H:i:s');
        $error = false;
        if (!empty($id) && is_numeric($id) && !empty($password)) {
            $user = $em->getRepository('YameiUserBundle:User')->find($id);
            if (!$user) {
                $error = true;
            } else {
                $user->setPassword($password);
                $user->setUpdTime($updTime);
                $em->flush();
                if ($user->getId()) {
                    $error = false;
                } else {
                    $error = true;
                }
            }
        } else {
            $error = true;
        }
        if ($error) {
            return new Response("修改失败！");
        } else {
            return new Response('修改成功！');
        }
    }

    function createSqlWhere($searchField, $searchString, $searchOper) {
        $operArray = array(
            'eq' => "`$searchField`  =  '$searchString'",
            'ne' => "`$searchField` !=  '$searchString'",
            'lt' => "`$searchField`  <  '$searchString'",
            'le' => "`$searchField`  <=  '$searchString'",
            'gt' => "`$searchField`  >  '$searchString'",
            'ge' => "`$searchField`  >= '$searchString'",
            'be' => "`$searchField` LIKE  '$searchString%'",
            'in' => "`$searchField` IN  '$searchString'",
            'ni' => "`$searchField` NOT IN  '$searchString'",
            'ew' => "`$searchField` LIKE '%$searchString'",
            'en' => "`$searchField` NOT LIKE '%$searchString'",
            'cn' => "`$searchField` LIKE  '%$searchString%'",
            'nc' => "`$searchField` NOT LIKE  '%$searchString%'",
            'nu' => "`$searchField`  IS NULL ",
            'nn' => "`$searchField`  IS NOT NULL "
        );
        return $operArray[$searchOper];
    }

}
