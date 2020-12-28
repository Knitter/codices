
lazy val root = (project in file("."))
  .enablePlugins(PlayJava)
  .settings(
    name := """Codices""",
    organization := "com.example",
    version := "1.0",
    scalaVersion := "2.13.4",
    resolvers += "scalaz-bintray" at "https://dl.bintray.com/scalaz/releases",
    libraryDependencies ++= Seq(
      guice,
      javaJdbc,
      evolutions
    ),
    javacOptions ++= Seq(
      "-encoding", "UTF-8",
      "-parameters",
      "-Xlint:unchecked",
      "-Xlint:deprecation",
      "-Werror"
    )
  )