<?php
namespace App\Exception;

/**
 * 错误码定义
 *
 * @author Meroc Chen <398515393@qq.com> 2017-11-22
 */
class ErrorCode {

  /**
   * MemberSv
   */
  public $APMISCODE = '100001';
  
  public $APMISMSG = '账号和密码不匹配！';

  public $AEPTCODE = '100002';

  public $AEPTMSG = '账户不存在！';

  public $RGEPTACCTCODE = '100003！';

  public $RGEPTACCTMSG = '账户名不可为空！';

  public $WOLDPASSCODE = '100004';

  public $WOLDPASSMSG = '旧密码错误！';

  public $MEMBERNOTFOUNDMSG = '没有查找到会员！';

  public $MEMBERNOTFOUNDCODE = '100005';

  public $DUPLICATEACCOUNTMSG = '重复的账户名！';

  public $DUPLICATEACCOUNTCODE = '100006';

  /**
   * MobileVerifyCodeSv
   */
  public $VRCODEEPCODE = '200001';

  public $VRCODEEPMSG = '验证码不能为空！';

  public $VRMOBILEEPTCODE = '200002';

  public $VRMOBILEEPTMSG = '手机号不能为空！';

  public $VMTIMECODE = '200003';

  public $VRMOBILWRONGCODE = '200004';

  public $VRMOBILWRONGMSG = '验证码错误或已失效，请重新发送！';

  /**
   * AuthorSv
   */
  public $AUDITTINGCODE = '300001';

  public $AUDITTINGMSG = '信息在审核中！';

  public $AUEXISTCODE = '300002';

  public $AUEXISTMSG = '该用户已经是作者了！';

  /**
   * AlbumSv
   */
  public $NOTAUTHORCODE = '400001';

  public $NOTAUTHORMSG = '不是作者！';

  public $ABNOTFOUNDCODE = '400002';

  public $ABNOTFOUNDMSG = '专辑不存在！！';
    
  /**
   * COMMON
   */
  public $NOMEMCODE = '111101';

  public $NOMEMMSG = '找寻不到会员！';

  /**
   * SUBMAIL
   */
  public $TMPIDMISSCODE = '500001';

  public $TMPIDMISSMSG = '模版id不能为空！';

  /**
   * VIDEO
   */
  public $VDMISSCODE = '600001';

  public $VDMISSMSG = '视频不存在！';

  public $VDEMPTYCODE = '600002';

  public $VDEMPTYMSG = '更新内容不能为空！';

  /**
   * UPLOADFILE
   *
   */
  public $DUPLICATEBKFILECODE = '800001';

  public $DUPLICATEBKFILEMSG = '重复的文件！';

  public $FILETRANSFERFAILEDCODE = '800002';

  public $FILETRANSFERFAILEDMSG = '复制文件失败！';

  /**
   * reward rule for cards
   */
  public $DUPLICATECARDRULECODE = '900001';

  public $DUPLICATECARDRULEMSG = '请勿重复定义规则！';

  /**
   * account
   *
   */
  public $DUPLICATEACCOUNTCODE = '110001';

  public $DUPLICATEACCOUNTMSG = '账户不能重复!';

  public $NORESTCODE = '110002';

  public $NORESTMSG = '账户余额不足！';

  /**
   * BUSINESS APPLY
   *
   */
  public $LOANSYNCFAILEDMSG = '贷款申请同步失败！';

  public $LOANSYNCFAILEDCODE = '210001';

}
