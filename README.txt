�y�������@�z
1, MariaDB��Root���[�U�[�Ń��O�C��

2, �Ǘ��҃��[�U�[�̍쐬���s��
	create user 'issue'@'localhost' identified by 'password';

3, �쐬����issue��USE�����g�p���ăf�[�^�x�[�X�̍쐬���s���B
	create database issuedb character set utf8 collate utf8_general_ci;
	grant all privileges ON issuedb.* TO 'issue'@'localhost';
	flush privileges;

4, ������.spl�t�@�C�������ɁC�f�[�^�x�[�X���쐬����

5, htdocs�f�B���N�g����imeges�t�H���_�Ɍ�����^����
	chmod 777 /Applications/XAMPP/xamppfiles/htdocs/images


�y���s���@�z
1, XAMPP���N�����S�ẴT�[�o�[�����s�\��ԂƂ���
2, http://localhost/index_2.php�ɃA�N�Z�X����

�y���V�s���L�T�C�g�̓���m�F���@�z
1, ����o�^���s��
2, �o�^�������[���A�h���X�ƃp�X���[�h�Ń��O�C�����s��
3, �g�b�v��ʂɑJ�ڌ�C�C�ӂ̃{�^�����N���b�N���C����m�F���s��