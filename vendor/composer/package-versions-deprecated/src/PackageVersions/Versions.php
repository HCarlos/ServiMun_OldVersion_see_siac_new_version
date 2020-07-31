<?php

declare(strict_types=1);

namespace PackageVersions;

use Composer\InstalledVersions;
use OutOfBoundsException;

/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 *
 * @deprecated in favor of the Composer\InstalledVersions class provided by Composer 2. Require composer-runtime-api:^2 to ensure it is present.
 */
final class Versions
{
    /**
     * @deprecated please use {@see \Composer\InstalledVersions::getRootPackage()} instead. The
     *             equivalent expression for this constant's contents is
     *             `\Composer\InstalledVersions::getRootPackage()['name']`.
     *             This constant will be removed in version 2.0.0.
     */
    const ROOT_PACKAGE_NAME = 'laravel/laravel';

    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS          = array (
  'caouecs/laravel-lang' => '7.0.1@fe2872f7c2dd19afb11d83443a81ac9e8e4cb2b8',
  'composer/package-versions-deprecated' => '1.10.99@dd51b4443d58b34b6d9344cf4c288e621c9a826f',
  'dnoegel/php-xdg-base-dir' => 'v0.1.1@8f8a6e48c5ecb0f991c2fdcf5f154a47d85f9ffd',
  'doctrine/annotations' => '1.10.3@5db60a4969eba0e0c197a19c077780aadbc43c5d',
  'doctrine/cache' => '1.10.2@13e3381b25847283a91948d04640543941309727',
  'doctrine/collections' => '1.6.7@55f8b799269a1a472457bd1a41b4f379d4cfba4a',
  'doctrine/common' => '3.0.2@a3c6479858989e242a2465972b4f7a8642baf0d4',
  'doctrine/dbal' => '2.10.2@aab745e7b6b2de3b47019da81e7225e14dcfdac8',
  'doctrine/event-manager' => '1.1.0@629572819973f13486371cb611386eb17851e85c',
  'doctrine/inflector' => '2.0.3@9cf661f4eb38f7c881cac67c75ea9b00bf97b210',
  'doctrine/instantiator' => '1.3.1@f350df0268e904597e3bd9c4685c53e0e333feea',
  'doctrine/lexer' => '1.2.1@e864bbf5904cb8f5bb334f99209b48018522f042',
  'doctrine/orm' => '2.8.x-dev@505d658e3d59dec9cba3732ede2bef7f534c3bd9',
  'doctrine/persistence' => '2.0.0@1dee036f22cd5dc0bc12132f1d1c38415907be55',
  'doctrine/reflection' => '1.2.1@55e71912dfcd824b2fdd16f2d9afe15684cfce79',
  'dragonmantank/cron-expression' => 'v2.3.0@72b6fbf76adb3cf5bc0db68559b33d41219aba27',
  'egulias/email-validator' => '2.1.18@cfa3d44471c7f5bfb684ac2b0da7114283d78441',
  'elibyy/tcpdf-laravel' => '7.0.0@0d6a16931b274566da59c06e59d8561e54f50bc6',
  'fideloper/proxy' => '4.4.0@9beebf48a1c344ed67c1d36bb1b8709db7c3c1a8',
  'fzaninotto/faker' => 'v1.9.1@fc10d778e4b84d5bd315dad194661e091d307c6f',
  'guzzlehttp/guzzle' => '6.5.5@9d4290de1cfd701f38099ef7e183b64b4b7b0c5e',
  'guzzlehttp/promises' => 'v1.3.1@a59da6cf61d80060647ff4d3eb2c03a2bc694646',
  'guzzlehttp/psr7' => '1.6.1@239400de7a173fe9901b9ac7c06497751f00727a',
  'intervention/image' => '2.5.1@abbf18d5ab8367f96b3205ca3c89fb2fa598c69e',
  'laravel/framework' => 'v6.18.31@a731824421f9ebc586728ea9c7cff231a249aaa9',
  'laravel/socialite' => 'v4.4.1@80951df0d93435b773aa00efe1fad6d5015fac75',
  'laravel/tinker' => 'v2.4.1@3c9ef136ca59366bc1b50b7f2500a946d5149c62',
  'laravelcollective/html' => 'v6.1.2@5ef9a3c9ae2423fe5618996f3cde375d461a3fc6',
  'laravelcollective/remote' => 'v6.1.1@5b2e49f4e80343b4c43d39124e7cee531329c9fb',
  'league/commonmark' => '1.5.3@2574454b97e4103dc4e36917bd783b25624aefcd',
  'league/flysystem' => '1.0.70@585824702f534f8d3cf7fab7225e8466cc4b7493',
  'league/oauth1-client' => '1.7.0@fca5f160650cb74d23fc11aa570dd61f86dcf647',
  'maatwebsite/excel' => '3.1.20@39545fa96b84d5a90f702239659c49a5d7b1edea',
  'maennchen/zipstream-php' => '2.1.0@c4c5803cc1f93df3d2448478ef79394a5981cc58',
  'markbaker/complex' => '1.4.8@8eaa40cceec7bf0518187530b2e63871be661b72',
  'markbaker/matrix' => '1.2.0@5348c5a67e3b75cd209d70103f916a93b1f1ed21',
  'monolog/monolog' => '2.1.1@f9eee5cec93dfb313a38b6b288741e84e53f02d5',
  'myclabs/php-enum' => '1.7.6@5f36467c7a87e20fbdc51e524fd8f9d1de80187c',
  'nesbot/carbon' => '2.37.0@1f61206de973d67f36ce50f041c792ddac663c3e',
  'nikic/php-parser' => 'v4.7.0@21dce06dfbf0365c6a7cc8fdbdc995926c6a9300',
  'opis/closure' => '3.5.5@dec9fc5ecfca93f45cd6121f8e6f14457dff372c',
  'opsway/doctrine-dbal-postgresql' => 'v0.8.1@fda403a60653c09637403384485f6db3c2e4ff73',
  'paragonie/random_compat' => 'v9.99.99@84b4dfb120c6f9b4ff7b3685f9b8f1aa365a0c95',
  'php-parallel-lint/php-console-color' => 'v0.3@b6af326b2088f1ad3b264696c9fd590ec395b49e',
  'php-parallel-lint/php-console-highlighter' => 'v0.5@21bf002f077b177f056d8cb455c5ed573adfdbb8',
  'phpoffice/phpspreadsheet' => '1.14.1@2383aad5689778470491581442aab38cec41bf1d',
  'phpoption/phpoption' => '1.7.5@994ecccd8f3283ecf5ac33254543eb0ac946d525',
  'phpseclib/phpseclib' => '2.0.28@d1ca58cf33cb21046d702ae3a7b14fdacd9f3260',
  'picqer/php-barcode-generator' => 'v2.0.1@16c51a795454198500cdfb4f82de288945af3960',
  'predis/predis' => 'v1.1.x-dev@111d100ee389d624036b46b35ed0c9ac59c71313',
  'psr/container' => '1.0.0@b7ce3b176482dbbc1245ebf52b181af44c2cf55f',
  'psr/http-client' => '1.0.1@2dfb5f6c5eff0e91e20e913f8c5452ed95b86621',
  'psr/http-factory' => '1.0.1@12ac7fcd07e5b077433f5f2bee95b3a771bf61be',
  'psr/http-message' => '1.0.1@f6561bf28d520154e4b0ec72be95418abe6d9363',
  'psr/log' => '1.1.3@0f73288fd15629204f9d42b7055f72dacbe811fc',
  'psr/simple-cache' => '1.0.1@408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
  'psy/psysh' => 'v0.10.4@a8aec1b2981ab66882a01cce36a49b6317dc3560',
  'ralouphie/getallheaders' => '3.0.3@120b605dfeb996808c31b6477290a714d356e822',
  'ramsey/uuid' => '3.9.3@7e1633a6964b48589b142d60542f9ed31bd37a92',
  'setasign/fpdf' => '1.8.2@d77904018090c17dc9f3ab6e944679a7a47e710a',
  'spatie/laravel-permission' => '3.13.0@49b8063fbb9ec52ebef98cc6ec527a80d8853141',
  'swiftmailer/swiftmailer' => 'v6.2.3@149cfdf118b169f7840bbe3ef0d4bc795d1780c9',
  'symfony/console' => 'v4.4.11@55d07021da933dd0d633ffdab6f45d5b230c7e02',
  'symfony/css-selector' => 'v5.1.3@e544e24472d4c97b2d11ade7caacd446727c6bf9',
  'symfony/debug' => 'v4.4.11@47aa9064d75db36389692dd4d39895a0820f00f2',
  'symfony/event-dispatcher' => 'v4.4.11@6140fc7047dafc5abbe84ba16a34a86c0b0229b8',
  'symfony/event-dispatcher-contracts' => 'v1.1.9@84e23fdcd2517bf37aecbd16967e83f0caee25a7',
  'symfony/finder' => 'v4.4.11@2727aa35fddfada1dd37599948528e9b152eb742',
  'symfony/http-foundation' => 'v4.3.8@cabe67275034e173350e158f3b1803d023880227',
  'symfony/http-kernel' => 'v4.3.11@fcd8fe5b98d435da856b310a01a4f281668607c0',
  'symfony/mime' => 'v4.3.8@22aecf6b11638ef378fab25d6c5a2da8a31a1448',
  'symfony/polyfill-ctype' => 'v1.18.0@1c302646f6efc070cd46856e600e5e0684d6b454',
  'symfony/polyfill-iconv' => 'v1.18.0@6c2f78eb8f5ab8eaea98f6d414a5915f2e0fce36',
  'symfony/polyfill-intl-idn' => 'v1.18.0@bc6549d068d0160e0f10f7a5a23c7d1406b95ebe',
  'symfony/polyfill-intl-normalizer' => 'v1.18.0@37078a8dd4a2a1e9ab0231af7c6cb671b2ed5a7e',
  'symfony/polyfill-mbstring' => 'v1.18.0@a6977d63bf9a0ad4c65cd352709e230876f9904a',
  'symfony/polyfill-php70' => 'v1.18.0@0dd93f2c578bdc9c72697eaa5f1dd25644e618d3',
  'symfony/polyfill-php72' => 'v1.18.0@639447d008615574653fb3bc60d1986d7172eaae',
  'symfony/polyfill-php73' => 'v1.18.0@fffa1a52a023e782cdcc221d781fe1ec8f87fcca',
  'symfony/polyfill-php80' => 'v1.18.0@d87d5766cbf48d72388a9f6b85f280c8ad51f981',
  'symfony/process' => 'v4.4.11@65e70bab62f3da7089a8d4591fb23fbacacb3479',
  'symfony/routing' => 'v4.4.11@e103381a4c2f0731c14589041852bf979e97c7af',
  'symfony/service-contracts' => 'v2.1.3@58c7475e5457c5492c26cc740cc0ad7464be9442',
  'symfony/translation' => 'v4.3.11@46e462be71935ae15eab531e4d491d801857f24c',
  'symfony/translation-contracts' => 'v1.1.9@a5db6f7707fd35d137b1398734f2d745c8616ea2',
  'symfony/var-dumper' => 'v4.4.11@2125805a1a4e57f2340bc566c3013ca94d2722dc',
  'tecnickcom/tc-lib-file' => '1.6.14@4ea05098b69ef7f6098eeab9162ffa8fb033e4f3',
  'tecnickcom/tc-lib-pdf-encrypt' => '1.5.10@9b2ef81b4879e6f0e339ad0ffb1ee8d5e68f389f',
  'tecnickcom/tc-lib-pdf-font' => '1.8.7@224af568fd9e83928d5f408c2dac3004124a9417',
  'tecnickcom/tc-lib-unicode-data' => '1.6.11@38e150c5c3a71520647685f21bc766f1a19eb0dd',
  'tecnickcom/tcpdf' => '6.3.5@19a535eaa7fb1c1cac499109deeb1a7a201b4549',
  'tijsverkoyen/css-to-inline-styles' => '2.2.3@b43b05cf43c1b6d849478965062b6ef73e223bb5',
  'vlucas/phpdotenv' => 'v3.6.7@2065beda6cbe75e2603686907b2e45f6f3a5ad82',
  'yajra/laravel-datatables-oracle' => 'v9.10.2@7ccbc890aa03d645bd509c03299234dc631240ee',
  'filp/whoops' => '2.7.3@5d5fe9bb3d656b514d455645b3addc5f7ba7714d',
  'myclabs/deep-copy' => '1.10.1@969b211f9a51aa1f6c01d1d2aef56d3bd91598e5',
  'nunomaduro/collision' => 'v3.0.1@af42d339fe2742295a54f6fdd42aaa6f8c4aca68',
  'phar-io/manifest' => '1.0.3@7761fcacf03b4d4f16e7ccb606d4879ca431fcf4',
  'phar-io/version' => '2.0.1@45a2ec53a73c70ce41d55cedef9063630abaf1b6',
  'phpdocumentor/reflection-common' => '2.2.0@1d01c49d4ed62f25aa84a747ad35d5a16924662b',
  'phpdocumentor/reflection-docblock' => '5.2.0@3170448f5769fe19f456173d833734e0ff1b84df',
  'phpdocumentor/type-resolver' => '1.3.0@e878a14a65245fbe78f8080eba03b47c3b705651',
  'phpspec/prophecy' => '1.11.1@b20034be5efcdab4fb60ca3a29cba2949aead160',
  'phpunit/php-code-coverage' => '8.0.2@ca6647ffddd2add025ab3f21644a441d7c146cdc',
  'phpunit/php-file-iterator' => '3.0.4@25fefc5b19835ca653877fe081644a3f8c1d915e',
  'phpunit/php-invoker' => '3.0.2@f6eedfed1085dd1f4c599629459a0277d25f9a66',
  'phpunit/php-text-template' => '2.0.2@6ff9c8ea4d3212b88fcf74e25e516e2c51c99324',
  'phpunit/php-timer' => '5.0.1@cc49734779cbb302bf51a44297dab8c4bbf941e7',
  'phpunit/php-token-stream' => '4.0.3@5672711b6b07b14d5ab694e700c62eeb82fcf374',
  'phpunit/phpunit' => '9.2.6@1c6a9e4312e209e659f1fce3ce88dd197c2448f6',
  'sebastian/code-unit' => '1.0.5@c1e2df332c905079980b119c4db103117e5e5c90',
  'sebastian/code-unit-reverse-lookup' => '2.0.2@ee51f9bb0c6d8a43337055db3120829fa14da819',
  'sebastian/comparator' => '4.0.3@dcc580eadfaa4e7f9d2cf9ae1922134ea962e14f',
  'sebastian/diff' => '4.0.2@1e90b4cf905a7d06c420b1d2e9d11a4dc8a13113',
  'sebastian/environment' => '5.1.2@0a757cab9d5b7ef49a619f1143e6c9c1bc0fe9d2',
  'sebastian/exporter' => '4.0.2@571d721db4aec847a0e59690b954af33ebf9f023',
  'sebastian/global-state' => '4.0.0@bdb1e7c79e592b8c82cb1699be3c8743119b8a72',
  'sebastian/object-enumerator' => '4.0.2@074fed2d0a6d08e1677dd8ce9d32aecb384917b8',
  'sebastian/object-reflector' => '2.0.2@127a46f6b057441b201253526f81d5406d6c7840',
  'sebastian/recursion-context' => '4.0.2@062231bf61d2b9448c4fa5a7643b5e1829c11d63',
  'sebastian/resource-operations' => '3.0.2@0653718a5a629b065e91f774595267f8dc32e213',
  'sebastian/type' => '2.2.1@86991e2b33446cd96e648c18bcdb1e95afb2c05a',
  'sebastian/version' => '3.0.1@626586115d0ed31cb71483be55beb759b5af5a3c',
  'theseer/tokenizer' => '1.2.0@75a63c33a8577608444246075ea0af0d052e452a',
  'webmozart/assert' => '1.9.1@bafc69caeb4d49c39fd0779086c03a3738cbb389',
  'laravel/laravel' => 'dev-master@fdccdbec98be023c3db737a04c17adcf7e2dbd7a',
);

    private function __construct()
    {
        class_exists(InstalledVersions::class);
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function getVersion(string $packageName): string
    {
        if (class_exists(InstalledVersions::class, false)) {
            return InstalledVersions::getPrettyVersion($packageName)
                . '@' . InstalledVersions::getReference($packageName);
        }

        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }
}
