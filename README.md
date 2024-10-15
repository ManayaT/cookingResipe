## 使用技術
![Static Badge](https://img.shields.io/badge/Java-blue) ![Static Badge](https://img.shields.io/badge/Maven-orange) ![Static Badge](https://img.shields.io/badge/Jsoup-lightblue) ![Static Badge](https://img.shields.io/badge/IntelliJ_IDEA-purple) ![Static Badge](https://img.shields.io/badge/FFmpeg-green)

# JavaYoutubeDownloader

## プロジェクトの概要
- このプロジェクトは教育目的で作成されたものであり，著作権の侵害や利用規約の違反を目的としたものではありません．また，上記のような利用を固く禁止します． 

- このプログラムは，動画共有サイトYouTubeにおいて，以下の場合に該当する動画や音楽をダウンロードすることができます．
  1. YouTubeよって明示的に承認されている場合
  2. YouTubeおよび（適用される場合）各権利所持者が事前に書面で許可している場合

- 現在，このプログラムは動画をダウンロードする機能が停止しています．これには，以下の理由が予測されています．<br>
  1. 動画への直接URLにおける，時間制限トークンの管理方法の変更
  2. YouTubeによる，ユーザ認証機能の仕様変更
 
## 環境
| 言語・フレームワーク  | バージョン |
| --------------------- | ---------- |
| Java                | JDK 17     |
| Jsoup                | 1.16.1      |
| FFmpeg                | 6.0      |

## ディレクトリ構成
```
.
├── out
│   └── artifacts
│       └── YouTubeDownloader_jar
│           └── YouTubeDownloader.jar
├── pom.xml
├── src
│   ├── main
│   │   ├── java
│   │   │   ├── AllByte.java
│   │   │   ├── AnalysisURL.java
│   │   │   ├── CompositionData.java
│   │   │   ├── ConnectHTML.java
│   │   │   ├── DataDownload.java
│   │   │   ├── FileDelete.java
│   │   │   ├── FileLocation.java
│   │   │   ├── InputExtension.java
│   │   │   ├── InputURL.java
│   │   │   ├── ItagAudioList.java
│   │   │   ├── ItagContains.java
│   │   │   ├── ItagMovieList.java
│   │   │   ├── ItagVideoList.java
│   │   │   ├── Manager.java
│   │   │   ├── NameSetting.java
│   │   │   ├── SelectQuality.java
│   │   │   ├── Time.java
│   │   │   └── VideoTitle.java
│   │   └── resources
│   │       └── META-INF
│   │           └── MANIFEST.MF
│   └── test
│       └── java
└── target
    ├── classes
    │   ├── AllByte.class
    │   ├── AnalysisURL.class
    │   ├── CompositionData.class
    │   ├── ConnectHTML.class
    │   ├── DataDownload.class
    │   ├── FileDelete.class
    │   ├── FileLocation.class
    │   ├── InputExtension.class
    │   ├── InputURL.class
    │   ├── ItagAudioList.class
    │   ├── ItagContains.class
    │   ├── ItagMovieList.class
    │   ├── ItagVideoList.class
    │   ├── META-INF
    │   │   └── MANIFEST.MF
    │   ├── Manager.class
    │   ├── NameSetting.class
    │   ├── SelectQuality.class
    │   ├── Time.class
    │   └── VideoTitle.class
    └── generated-sources
        └── annotations
```

## 環境構築
- FFmpegのインストール
```
  $ brew install ffmpeg
```
- プロジェクトをMavanを使用して立ち上げ，Jsoupをロードする
```
<dependencies>
    <dependency>
        <groupId>org.jsoup</groupId>
        <artifactId>jsoup</artifactId>
        <version>1.16.1</version>
    </dependency>
</dependencies>
```

## 変数設計
| 変数  | 役割 | 状態 |
| --------------------- | ---------- | ---------- |
| inputURL                | 入力URLの保持     | private     |
| audioURL                | 音声データURLの保持     | private     |
| videoURL                | 映像データURLの保持     | private     |
| movieURL                | 音声+映像データURLの保持     | private     |
| htmlContent                | Jsoupで取得したHTMLの保持     | private     |
| itagAudioList                | 指定値のitagリストを保持     | private     |
| itagVideoList                | 指定値のitagリストを保持     | private     |
| itagMovieList                | 指定値のitagリストを保持     | private     |
| inputQuality                | 入力画質保持変数     | private     |
| extension                | 入力拡張子保持変数     | private     |
| workingPath                | 保存先のパスを保持     | private     |
| fileName                | 保存時のファイル名を保持     | private     |
| currentTime                | 一時保存ファイルの仮名用に現在時刻を保持     | private     |
| contentSize                | プログレスパーの表示用     | private     |

```mermaid
graph TD;
  initial(.jarファイルの起動)-->inputURL[任意の動画URLを入力];
  inputURL-->connectHTML[HTMLの取得];

  connectHTML-->AnalysisURL{取得したHTMLテキストにitagが存在するか};
  AnalysisURL-->|True| inputExtension[任意の出力用拡張子を入力];
  AnalysisURL-->|False| inputURL;

  inputExtension-->whitchExtension{拡張子の種類};
  whitchExtension-->|.mp4 or .mp3| inputFileLocation[保存先の入力];
  whitchExtension-->|other| inputExtension;

  inputFileLocation-->existsLocation{保存先が存在しているか};
  existsLocation-->|True| inputFilename[ファイルの出力名を入力];
  existsLocation-->|False| inputFileLocation;

  inputFilename-->videoTitle{出力名に禁則文字が含まれていないか};
  videoTitle-->|True| getDataURL[HTMLに対してスクレイピングの実行];
  videoTitle-->|False| inputFilename;

  getDataURL-->audioDownload[音声データのダウンロード];

  audioDownload-->download_1{ダウンロードが成功したか};
  download_1-->|True| videoDownload[動画データのダウンロード];
  download_1-->|False| deleteFile[不要データの削除];

  videoDownload-->download_2{ダウンロードが成功したか};
  download_2-->|True| composeData[FFmpegを用いてデータを合成];
  download_2-->|False| deleteFile[不要データの削除];

  composeData-->deleteFile[不要データの削除];

  deleteFile-->continue{実行を続けるかどうか};
  continue-->|True| inputURL;
  continue-->|False| movieEnd(終了);
```
