<div id="info_def" style="display:none">
<div class="loader-container"></div>

<div class="alert-container">
    <div class="alert-content align-content align-center">
        <div class="col-md-1 align-content" style="display:flex;">
            <div class="col-md-6"  style="padding: 0px;">
                <div class="panel">
                    <div class="panel-header col-md-9 flex-wrap panel-content-padding">
                        <div class="line-panel table">
                            <div class="col-md-9 panel-content-padding">
                                <input class="close" type="button" value="x"
                                onclick="closeInfoDeficiency()" />
                            </div>
                        </div>

                        <div class="line-panel align-content">
                            <div class="title-box margin-bottom-5px panel-content-padding">
                                <h3><span id="title">Deficiências</span></h3>
                            </div>
                        </div>

                        <div class="line-panel align-content">
                            <div class="panel-body" id="def">
                                <div class="line-panel table margin-bottom-20px">
                                    <div class="col-1 total-width">
                                        <label class="info-def-subtitle">Física</label>
                                    </div>
                                    <div class="col-md-3 panel-content-padding">
                                        <div class="col-1">
                                            <input type="checkbox"  class="check-mk" id="chk-fi-01">
                                            <label for="chk-fi-01" class="info-def-text">Amputação</label>
                                        </div>
                                        <div class="col-1">
                                            <input type="checkbox"  class="check-mk" id="chk-fi-02">
                                            <label for="chk-fi-02" class="info-def-text">Cadeirante</label>
                                        </div>
                                        <div class="col-1">
                                            <input type="checkbox"  class="check-mk" id="chk-fi-03">
                                            <label for="chk-fi-03" class="info-def-text">Membros Inferiores</label>
                                        </div>
                                        <div class="col-1">
                                            <input type="checkbox"  class="check-mk" id="chk-fi-04">
                                            <label for="chk-fi-04" class="info-def-text">Um membro Inferior</label>
                                        </div>
                                        <div class="col-1">
                                            <input type="checkbox"  class="check-mk" id="chk-fi-05">
                                            <label for="chk-fi-05" class="info-def-text">Membros Superiores</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 panel-content-padding">
                                        <div class="col-1">
                                            <input type="checkbox"  class="check-mk" id="chk-fi-06">
                                            <label for="chk-fi-06" class="info-def-text">Um membro Superior</label>
                                        </div>
                                        <div class="col-1">
                                            <input type="checkbox"  class="check-mk" id="chk-fi-07">
                                            <label for="chk-fi-07" class="info-def-text">Nanismo</label>
                                        </div>
                                        <div class="col-1">
                                            <input type="checkbox"  class="check-mk" id="chk-fi-08">
                                            <label for="chk-fi-08" class="info-def-text">Ostomia</label>
                                        </div>
                                        <div class="col-1">
                                            <input type="checkbox"  class="check-mk" id="chk-fi-09">
                                            <label for="chk-fi-09" class="info-def-text">Paralisia Cerebral</label>
                                        </div>
                                        <div class="col-1">
                                            <input type="checkbox"  class="check-mk" id="chk-fi-10">
                                            <label for="chk-fi-10" class="info-def-text">Parcial</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="line-panel table margin-bottom-20px">
                                    <div class="col-1 total-width">
                                        <label class="info-def-subtitle">Auditiva</label>
                                    </div>
                                    <div class="col-md-3 panel-content-padding">
                                        <div class="col-1">
                                            <input type="checkbox"  class="check-mk" id="chk-hearing-01">
                                            <label for="chk-hearing-01" class="info-def-text">Surdez Bilateral Parcial</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 panel-content-padding">
                                        <div class="col-1">
                                            <input type="checkbox"  class="check-mk" id="chk-hearing-02">
                                            <label for="chk-hearing-02" class="info-def-text">Surdez Bilateral Total</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="line-panel table margin-bottom-20px">
                                    <div class="col-1 total-width">
                                        <label class="info-def-subtitle">Visual</label>
                                    </div>
                                    <div class="col-md-3 panel-content-padding">
                                        <div class="col-1">
                                            <input type="checkbox"  class="check-mk" id="chk-vs-01">
                                            <label for="chk-vs-01" class="info-def-text">Baixa Visão</label>
                                        </div>
                                        <div class="col-1">
                                            <input type="checkbox"  class="check-mk" id="chk-vs-02">
                                            <label for="chk-vs-02" class="info-def-text">Cegueira</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 panel-content-padding">
                                        <div class="col-1">
                                            <input type="checkbox"  class="check-mk" id="chk-vs-03">
                                            <label for="chk-vs-03" class="info-def-text">Monocular</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="line-panel table margin-bottom-20px">
                                    <div class="col-1 total-width">
                                        <label class="info-def-subtitle">Mental/Intelectual</label>
                                    </div>
                                    <div class="col-md-3 panel-content-padding">
                                        <div class="col-1">
                                            <input type="checkbox"  class="check-mk" id="mt-in">
                                            <label for="mt-in" class="info-def-text">Mental/Intelectual</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="line-panel table margin-bottom-20px">
                                    <div class="col-1 total-width">
                                        <label>Outros</label>
                                    </div>
                                    <div class="col-md-3 panel-content-padding">
                                        <div class="col-1">
                                            <input type="checkbox"  class="check-mk" id="other">
                                            <label for="other" class="info-def-text">Outros</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        

                        <div class="line-panel align-content">
                            <div class="col-1 total-width panel-content-padding">
                                <div class="dividing-1"></div>
                            </div>
                        </div>

                        <div class="line-panel table align-content">
                            <div class="col-md-3">
                                <div class="col-1">
                                    <input class="btn" type="button" value="OK"
                                    onclick="configInfoDeficiency()" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>