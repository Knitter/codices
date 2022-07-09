module eu.sergiolopes.codices {
    requires javafx.controls;
    requires javafx.fxml;

    requires org.controlsfx.controls;
    requires com.dlsc.formsfx;
    requires validatorfx;
    requires org.kordamp.bootstrapfx.core;

    opens eu.sergiolopes.codices to javafx.fxml;
    exports eu.sergiolopes.codices;
}